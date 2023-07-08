import java.io.IOException;
import java.net.DatagramPacket;
import java.net.DatagramSocket;
import java.net.InetAddress;

public class SocketServer {

    private final DatagramSocket server;
    private final DatagramPacket message;

    public SocketServer(DatagramSocket server, DatagramPacket message) {
        this.server = server;
        this.message = message;
    }

    public void start() throws IOException {
        while (true) {
            System.out.println("Server started....");
            server.receive(message);
            threatMessage();
        }
    }

    public void stop() {
        server.close();
    }

    private void threatMessage() throws IOException {

        String messageReceived = new String(message.getData()).trim();
        System.out.println("Message Received: " + messageReceived);

        if (messageReceived.equals("hello")) {

            InetAddress address = message.getAddress();
            int port = message.getPort();

            String sendMessage = "ok";
            byte[] byteSendMessage = sendMessage.getBytes();

            DatagramPacket answerPacket = new DatagramPacket(byteSendMessage, byteSendMessage.length, address, port);

            server.send(answerPacket);
        }
    }
}
