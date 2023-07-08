import org.junit.Test;
import static org.junit.jupiter.api.Assertions.assertEquals;
import java.net.InetAddress;
import java.net.UnknownHostException;


public class Testing {
    private final Belajar belajar = new Belajar();

    @Test
    public void testBelajar() throws UnknownHostException{
        InetAddress host = null;
        host = InetAddress.getLocalHost();
        String ipAddress = belajar.getIPAddressTest(host);

        assertEquals(getIPAddressTest(host), ipAddress, "The ip address is wrong");
    }

    public String getIPAddressTest(InetAddress host){
        byte ip[] = host.getAddress();
        String ipAddress = "";
        for (int i=0; i<ip.length; i++) { 
           if (i > 0) { 
            ipAddress += ".";
           } 
           ipAddress += (ip[i] & 0xff); 
       }
       return  ipAddress;
    }
}
