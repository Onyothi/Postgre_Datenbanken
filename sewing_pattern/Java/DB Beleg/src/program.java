import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.List;
import java.util.ArrayList;
import java.util.Scanner;
import java.io.IOException;


public class program {

	public static void main(String[] args) {
		final String table = "designer";
		ResultSet r;
		int result;
		String[] columns = null;
		String[] keys = null;
		Scanner sc;
		String[] menuOptions = {"Print table.", "New entry.", "Delete an entry.", "Navigate.", "Quit."};
		Menu mainMenu = new Menu(menuOptions);
		boolean exit = false;
		ASCIITable t;
		
		try {
			DBC qq = new DBC("jdbc:postgresql://db.f4.htw-berlin.de:5432/_s0548106__beleg", "_s0548106__beleg_generic", "testtest");
			
			// load columns
			try {
				List<String> tmp = new ArrayList<String>();
				r = qq.query(Query.getColumns(table));
					while (r.next()) {
					tmp.add(r.getString(1));
				}
				columns = tmp.toArray(new String[tmp.size()]);
			}
			catch (SQLException e) {
				e.printStackTrace();
			}
			
			// load keys
			try {
				List<String> tmp = new ArrayList<String>();
				r = qq.query(Query.getKeys(table));
				while (r.next()) {
					tmp.add(r.getString(1));
				}
				keys = tmp.toArray(new String[tmp.size()]);
			}
			catch (SQLException e) {
				e.printStackTrace();
			}

			t = new ASCIITable(columns);
			while (!exit) {
				switch(mainMenu.writeMenuAndWait()) {
					case 1:
						System.out.println("View all rows in table " + table);
						t = new ASCIITable(columns);
						try {
							r = qq.query(Query.select(table, columns, " true"));
							while (r.next()) {
								t.add(rowToSArray(r));
							}
							t.print();
						}
						catch (SQLException e) {
							e.printStackTrace();
						}
						break;
						
					case 2:
						System.out.println("Insert new entry into table " + table);
						List<String> tmp = new ArrayList<String>();
						sc = new Scanner(System.in);
						for (int i = 0; i < columns.length; i++) {
							System.out.print(columns[i] + ": ");
							tmp.add("'" + sc.nextLine() + "'");
						}
						try {
							result = qq.update(Query.insert(table, columns, tmp.toArray(new String[tmp.size()])));
							System.out.println(result + " row(s) added.");
						}
						catch (SQLException e) {
							System.out.println(e.getMessage());
						}				
						break;
						
					case 3:
						System.out.println("Delete an entry from table " + table);
						tmp = new ArrayList<String>();
						sc = new Scanner(System.in);
						for (int i = 0; i < keys.length; i++) {
							System.out.print(keys[i] + ": ");
							tmp.add("'" + sc.nextLine() + "'");
						}
							try {
								System.out.println(Query.delete(table, keys, tmp.toArray(new String[tmp.size()])));
								result = qq.update(Query.delete(table, keys, tmp.toArray(new String[tmp.size()])));
								System.out.println(result + " lines deleted.");
							}
							catch (SQLException e) {
	
							}
						break;
						
					case 4:
						System.out.println("Navigate through table " + table);
						System.out.println("(n - next, p - previous, q - cancel)\n");
						t = new ASCIITable(columns);
						try {
							r = qq.query(Query.select(table, columns, " true"));
							while (r.next()) {
								t.add(rowToSArray(r));
							}
						}
						catch (SQLException e) {
							e.printStackTrace();
						}
						final int rows = t.getEntriesAmount();
						int step = 0;
						boolean repeat = true;
						
						while (repeat) {
							if (step < 0) {
								step = rows - 1;
							}
							else if(step > (rows - 1)) {
								step = 0;
							}
							t.printOne(step);
							try {
								if (checker()) {
									step++;
								}
								else {
									step--;
								}
							}
							catch (Quit q) {
								repeat = false;
							}
						}
						break;
						
					case 5:
						System.out.println("Quit program.");
						exit = true;
						break;
						
					default:
						System.out.println("No such option. Try again.");
						break;
						
				} // switch case
				Menu.PressEnterToContinue();
			} // while
		}
		catch (Exception e) {
			System.out.println("Can't get a connection: "+e.toString());
			System.exit(0);
		}
		System.out.println();
	} // main

	public static String[] rowToSArray(ResultSet r) throws SQLException{
		List<String> tmp = new ArrayList<String>();
		int size = r.getMetaData().getColumnCount();
		for (int i = 1; i <= size; i++) {
			tmp.add(r.getString(i));
		}
		return tmp.toArray(new String[tmp.size()]);
	}	

	public static boolean checker() throws Quit {
		char a = 'N';
		boolean switcher = false;
			try {
				int i = System.in.read();
				a = (char)i;
				switch (a) {
					case 'p':
					case 'P':;switcher = false;break;
					case 'n':
					case 'N':switcher = true;break;
					case 'q':
					case 'Q': throw new Quit(""); 
					default: throw new IOException();
				}
				
			}
			catch (IOException e) {
				switcher = checker();
			}	
		return switcher;
	}

}

@SuppressWarnings("serial")
class Quit extends Exception {
	public Quit(String message) {
		super(message);
	}
}