/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

import java.io.IOException;
import java.net.DatagramPacket;
import java.net.DatagramSocket;
import java.net.InetAddress;
import java.net.SocketException;
import java.net.SocketTimeoutException;
import java.net.UnknownHostException;
import java.util.logging.Level;
import java.util.logging.Logger;
import org.junit.Test;
import static org.junit.Assert.*;

/**
 *
 * @author Administrator
 */
public class SocketClientTest {
    
    private int port = 5100;
    public static Logger logger = Logger.getLogger(SocketClientTest.class.getName());

    @Test
    public void test() throws IOException {

        DatagramSocket socket = new DatagramSocket(port);
        DatagramPacket packet = new DatagramPacket(new byte[256], 256);

        final SocketClient client = new SocketClient(socket, packet);

        new Thread(() -> {
            try {
                client.start();
            } catch (IOException e) {
                logger.log(Level.INFO, e.toString());
            }
        }).start();

        String resposta = sendMessage();
        client.stop();

        assertEquals("ok", resposta);
    }

    private String sendMessage() {

        try {

            DatagramSocket socket = new DatagramSocket();

            InetAddress ipAddress = InetAddress.getByName("127.0.0.1");

            String message = "hello";

            DatagramPacket messagePacket = new DatagramPacket(message.getBytes(), message.length(), ipAddress, port);
            socket.send(messagePacket);

            DatagramPacket receivePacket = new DatagramPacket(new byte[256], 256);

            socket.setSoTimeout(3000);

            socket.receive(receivePacket);
            String responseMessage = new String(receivePacket.getData()).trim();
            return responseMessage;

        } catch (SocketTimeoutException e) {
            System.out.println("Time expired");
            return "";
        } catch (SocketException e) {
            logger.log(Level.INFO, e.toString());
            return "";
        } catch (UnknownHostException e) {
            logger.log(Level.INFO, e.toString());
            return "";
        } catch (IOException e) {
            logger.log(Level.INFO, e.toString());
            return "";
        }
    }
}
