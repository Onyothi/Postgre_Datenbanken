import java.util.List;
import java.util.ArrayList;

class ASCIITable {

	private String[] header;
	private List<String[]> entries = new ArrayList<String[]>();

	ASCIITable(String[] header) {
		if (header.length > 0) {
			this.header = header;
		}
		else {
			throw new IllegalArgumentException();
		}
	}

	public void add(String[] entry) {
		if (entry.length == header.length) {
			entries.add(entry);
		}
	}

	public void printHead() {
		for (String s : header) {
			System.out.print(s + " | ");
		}		
	}

	public void printOne(int index) throws IndexOutOfBoundsException {
		if (index >= 0) {
			String[] t = entries.get(index);
			System.out.print("No. " + index + ": ");
			for (String q: t) {
				System.out.print(q + " | ");				
			}
			System.out.println();
		}
	}

	public void print() {
		printHead();
		System.out.println();
		for (int i = 0; i < entries.size(); i ++) {
			try {
				printOne(i);
			}
			catch (IndexOutOfBoundsException e) {

			}
		}		
	}

	public int getEntriesAmount() {
		return entries.size();
	}

	public void empty() {
		entries.clear();
	}


}