import java.net.*;
import java.util.concurrent.ExecutorService;
import java.util.concurrent.Executors;
import java.lang.Runnable;
import java.io.*;
import org.junit.Test;
import org.junit.After;
import org.junit.Before;
import org.junit.FixMethodOrder;
import org.junit.runners.MethodSorters;
import static org.junit.Assert.assertEquals;
import static org.junit.Assert.assertFalse;

@FixMethodOrder(MethodSorters.NAME_ASCENDING)

public class SimpleTCPTest {
    int TESTPORT = 8800;
    private boolean result = false;
    SimpleServer server;
    SimpleClient client;
    ServerSocket checkServer = null;
    String line = "";
    BufferedReader is = null;
    DataOutputStream os = null;
    Socket clientSocket = null;

    private synchronized void updateResult() {
        notifyAll();
    }

    private synchronized boolean getResult() throws InterruptedException {
        while (!result) {
            wait();
        }
        return result;
    }

    @Before
    public void setUp() throws Exception {
        server = new SimpleServer();
        client = new SimpleClient();
        checkServer = server.startServer(TESTPORT);
        client.initializeInputAndOutput(TESTPORT);
    }

    @After
    public void tearDown() throws Exception {
        if (clientSocket != null)
            clientSocket.close();
        if (checkServer != null)
            checkServer.close();
    }

    @Test
    public void test01StartServer() throws IOException {
        // checkServer = server.startServer(TESTPORT);
        assertEquals(TESTPORT, checkServer.getLocalPort());
    }

    @Test
    public void test02Initialize() throws Exception {
        // checkServer = server.startServer(TESTPORT);
        // client.initializeInputAndOutput(TESTPORT);
        
        // Socket clientSocket = new Socket("localhost", TESTPORT);

        // Start the server in a separate thread
        Runnable serverThread = new Runnable() {
            public void run() {
                result = server.initializeInputAndOutput();
                updateResult();
            }
        };
        ExecutorService executor = Executors.newCachedThreadPool();
        executor.submit(serverThread);

        // Wait for the server to start
        getResult();

        // // Connect to the server as a client and send a message
        // PrintWriter out = new PrintWriter(clientSocket.getOutputStream(), true);
        // out.println("salam");
        client.kirim();

        // Wait for the server to receive and respond to the message
        getResult();

        assertEquals(true, result);
    }

    @Test
    public void test03ReceiveMessage() throws IOException, InterruptedException {
        // checkServer = server.startServer(TESTPORT);

        System.out.println("\n");
        // client.initializeInputAndOutput(TESTPORT);
        client.kirim();

        Runnable serverThread = new Runnable() {
            public void run() {
                server.initializeInputAndOutput();
                updateResult(); // Update the result once the server thread has finished
            }
        };

        ExecutorService executor = Executors.newCachedThreadPool();
        executor.submit(serverThread);

        // Sleep for a short period to ensure the server thread is started
        Thread.sleep(10);

        line = server.getMessage();
        System.out.println("Kirim: " + line);
        assertEquals("salam juga", line);
    }

    // @Test
    // public void test04CloseServer() throws IOException{
    //     // server.closeServer();
    //     // client.closeClient();
    //     boolean resultClose;
    //     if(checkServer == null){
    //         resultClose = true;
    //     } else {
    //         resultClose = false;
    //     }
    //     assertEquals(true, resultClose);
    // }
}
