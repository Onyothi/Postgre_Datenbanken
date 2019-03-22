import java.util.Scanner;
import java.util.InputMismatchException;

class Menu {

	private String[] labels;

	
	Menu(String[] labels) {
		if (labels.length > 0) {
			this.labels = labels;
		}
		else {
			throw new IllegalArgumentException();
		}
	}

	public int writeMenuAndWait() {
		for (int i = 1; i <= labels.length; i++) {
			System.out.println(i + ". " + labels[i-1]);
		}
		System.out.println("Please enter a number from menu.");
		return number();
	}


	public static int number() {
		int a = 0;
		@SuppressWarnings("resource")
		Scanner sc = new Scanner(System.in);
		try {
			a = sc.nextInt();
		}
		catch (InputMismatchException e) {
			System.out.println("Try again.");
			a = number();
		}
		return a;
	}
	
	public static void PressEnterToContinue(){ 
		        System.out.println("Press ENTER to continue...");
		        try
		        {
		            System.in.read();
		        }  
		        catch(Exception e)
		        {}  
	}
}