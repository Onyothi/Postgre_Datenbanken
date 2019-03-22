//import com.sun.rowset.CachedRowSetImpl;
import java.sql.*;


public class DBC {

	private Connection dbcon;
	private Statement stmt;

	public DBC(String db_url, String username, String password) throws SQLException {
        dbcon = DriverManager.getConnection(db_url, username, password);
        stmt = dbcon.createStatement();
	}

    public ResultSet query(String query) throws SQLException {
        return stmt.executeQuery(query);	
    }
    
    public int update(String query) throws SQLException {
        return stmt.executeUpdate(query);	
    }

    public void close() {
        try{
            stmt.close();
            dbcon.close();
        }
        catch (Exception e){
           
        }
    }    

}