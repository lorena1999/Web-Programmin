package webapp;

import appLayer.User;

import javax.servlet.*;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;
import java.io.IOException;
import java.util.Date;

@WebServlet(name = "login")
public class login extends HttpServlet {

    protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {

        User userObject = new User();

        if(userObject.isValidCredentials(request.getParameter("loginname"), request.getParameter("password")))
        {
            request.setAttribute("username", userObject.getUsername());
            request.setAttribute("password", userObject.getPass());

            HttpSession ses = request.getSession(true);
            ses.setAttribute("isLogin",true);
            ses.setAttribute("username", userObject.getUsername());
            ses.setAttribute("id", userObject.getId());

            response.sendRedirect(request.getContextPath() + "/welcome.jsp?id="+userObject.getId());

        }
        else
        {
            request.setAttribute("errorMessage", "Invalid login and password. Try again");
            request.getRequestDispatcher("/login.jsp").forward(request, response);
        }
    }

    protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {

        //request.getRequestDispatcher("/welcome.jsp").forward(request,response);

        //response.sendRedirect(request.getContextPath() + "/welcome.jsp");
    }
}
