import java.lang.StringBuffer;

class Query {
	public static String select(String table, String[] fields, String whereAttach) {
		StringBuffer r = new StringBuffer("SELECT ");
		for (String f : fields) {
			r.append(f + ", ");
		}
		r.deleteCharAt(r.length() - 2);
		r.append("FROM " + table);
		r.append(" WHERE ");
		r.append(whereAttach);
		String s = r.toString();
		return s;
	}

	public static String delete(String table, String[] keys, String[] values) {
		StringBuffer r = new StringBuffer("DELETE FROM ");
		
		if (arrEqual(keys, values)) {
			r.append(table + " WHERE ");
			for (int i = 0; i < keys.length; i++) {
				r.append(keys[i]);
				r.append(" = ");
				r.append(values[i]);
				if (i != keys.length - 1) {
					r.append(" AND ");
				}
			}

		}
		String s = r.toString();
		return s;
	}

	private static boolean arrEqual(String[] f, String[] s) {
		return f.length == s.length;
	}

	public static String insert(String table, String[] fields, String[] values) {
		StringBuffer r = new StringBuffer("INSERT INTO ");
		
		if (arrEqual(fields, values)) {
			r.append(table + " (");
			for (String f : fields) {
				r.append(f + ", ");
			}
			r.deleteCharAt(r.length() - 2);
			r.append(") VALUES (");
			for (String f : values) {
				r.append(f + ", ");
			}
			r.deleteCharAt(r.length() - 2);
			r.append(")");
		}
		String s = r.toString();
		return s;
	}
	
	public static String getColumns(String table) {
		return ("SELECT column_name FROM information_schema.columns WHERE table_name = '" + table + "';");
	}
	
	public static String getKeys(String table) {
		StringBuffer r = new StringBuffer("SELECT ");
		r.append("pg_attribute.attname, format_type(pg_attribute.atttypid, pg_attribute.atttypmod) ");
		r.append("FROM pg_index, pg_class, pg_attribute, pg_namespace ");
		r.append("WHERE ");
		r.append("pg_class.oid = '" + table + "'::regclass AND ");
		r.append("indrelid = pg_class.oid AND ");
		r.append("nspname = 'public' AND ");
		r.append("pg_class.relnamespace = pg_namespace.oid AND ");
		r.append("pg_attribute.attrelid = pg_class.oid AND ");
		r.append("pg_attribute.attnum = any(pg_index.indkey) ");
		r.append("AND indisprimary; ");
		
		String s = r.toString();
		return s;
	}
}