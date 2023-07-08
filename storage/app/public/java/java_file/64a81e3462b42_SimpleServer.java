import java.io.*; 
import java.net.*; 
 
public class SimpleServer { 
    public final static int TESTPORT = 8800;
    static ServerSocket checkServer = null; 
    static String line = "";
    static BufferedReader is = null;
    static DataOutputStream os = null;
    static Socket clientSocket = null;

    public static ServerSocket startServer(int TESTPORT){
        try { 
            return checkServer = new ServerSocket(TESTPORT);  
        } 
        catch (IOException e) { 
            System.out.println(e); 
        }
        return null; 
    }

    public static boolean initializeInputAndOutput() {
        try {
            clientSocket = checkServer.accept();
            is = new BufferedReader(new InputStreamReader(clientSocket.getInputStream()));
            os = new DataOutputStream(clientSocket.getOutputStream());
            return true;
        } catch (Exception ei) {
            ei.printStackTrace();
        }
        return false;
    }        

    public static void receiveMessages(){
        try { 
            line = is.readLine(); 
            System.out.println("Terima : " + line); 
            if (line.compareTo("salam") == 0) { 
                os.writeBytes("salam juga"); 
            } 
            else { 
                os.writeBytes("Maaf, saya tidak mengerti"); 
            } 
        } 
        catch (IOException e) { 
            System.out.println(e); 
        }
    }

        public static String baca(){
        try { 
            line = is.readLine(); 
            System.out.println("Terima : " + line); 
            if (line.compareTo("salam") == 0) { 
                os.writeBytes("salam");
            } 
            else { 
                os.writeBytes("Maaf, saya tidak mengerti"); 
            } 
        } 
        catch (IOException e) { 
            System.out.println(e); 
        }
        return line;
    }

    public String getMessage(){
        try { 
            line = is.readLine(); 
            System.out.println("Terima : " + line); 
            if (line.compareTo("salam") == 0) { 
                os.writeBytes("salam juga");
                return "salam juga"; 
            } 
            else { 
                os.writeBytes("Maaf, saya tidak mengerti"); 
                return "Maaf, saya tidak mengerti";
            } 
        } 
        catch (IOException e) { 
            System.out.println(e); 
            return "ada error";
        }
    }

    public static void closeServer(){
        try { 
            os.close(); 
            is.close(); 
            clientSocket.close(); 
        } 
        catch (IOException ic) { 
            ic.printStackTrace(); 
        } 
    }

    public static void main(String args[]) {
    
        checkServer = startServer(TESTPORT);
        if (checkServer != null) {
            System.out.println("Aplikasi Server hidup ...");
        }
        
        if (initializeInputAndOutput()) {
            System.out.println("Server Ready");
            receiveMessages();
        }
    
        closeServer();
    }
}    