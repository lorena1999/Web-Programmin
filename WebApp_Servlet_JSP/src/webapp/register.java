package webapp;

import appLayer.User;
import dbLayer.MyConnectionProvider;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import java.io.IOException;
import java.sql.Connection;

@WebServlet(name = "register")
public class register extends HttpServlet {
    protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        User u = new User();

        if(!u.isUser(request.getParameter("username_reg")))
        {
            u.registerUser(request.getParameter("username_reg"), request.getParameter("password_reg"));

            request.setAttribute("username", u.getUsername());
            request.setAttribute("password", u.getPass());

            request.getRequestDispatcher("/login.jsp").forward(request,response);
        }
        else
        {
            request.setAttribute("errorMessage", "This user already exists! Try again");
            request.getRequestDispatcher("/login.jsp").forward(request, response);
        }

    }

    protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {

    }
}
