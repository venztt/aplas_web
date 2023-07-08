
import java.io.IOException;
import java.net.DatagramPacket;
import java.net.DatagramSocket;
import java.net.InetAddress;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author Administrator
 */
public class SocketClient {
    
    private final DatagramSocket client;
    private final DatagramPacket message;

    public SocketClient(DatagramSocket server, DatagramPacket message) {
        this.client = server;
        this.message = message;
    }

    public void start() throws IOException {
        while (true) {
            client.receive(message);
            threatMessage();
        }
    }

    public void stop() {
        client.close();
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

            client.send(answerPacket);
        }
    }
}
