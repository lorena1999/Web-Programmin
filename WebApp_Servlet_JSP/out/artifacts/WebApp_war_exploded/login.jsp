<%--
  Created by IntelliJ IDEA.
  User: LM
  Date: 5/3/2020
  Time: 3:59 PM
  To change this template use File | Settings | File Templates.
--%>
<%@ page contentType="text/html;charset=UTF-8" language="java" %>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="login.css">
</head>
<body>

    <%
        //session.setAttribute("isLogin", false);
    %>

    <div class="loginbox">
        <img src="avatar.png" class="avatar">
        <h1>Login Here</h1>
        <form action="login" method="post">
            <p>Username</p>
            <input type="text" name="loginname" placeholder="Enter Username">
            <p>Password</p>
            <input type="Password" name="password" placeholder="Enter Password">
            <input type="submit" name="login" value="Login">
        </form>

        <a href="register.jsp">Don't have an account?</a>

        <p style="color:red;">${errorMessage}</p>

    </div>

</body>
</html>


