// RectangleTest.java
import org.junit.Test;
import static org.junit.Assert.assertEquals;

public class RectangleTest {

    @Test
    public void testCalculateArea() {
        Rectangle rectangle = new Rectangle(5, 3);
        int area = rectangle.calculateArea();
        assertEquals(15, area);
    }

    @Test
    public void testCalculatePerimeter() {
        Rectangle rectangle = new Rectangle(5, 3);
        int perimeter = rectangle.calculatePerimeter();
        assertEquals(16, perimeter);
    }
}
