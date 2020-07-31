<%--
  Created by IntelliJ IDEA.
  User: LM
  Date: 5/3/2020
  Time: 5:30 PM
  To change this template use File | Settings | File Templates.
--%>
<%@ page contentType="text/html;charset=UTF-8" language="java" %>
<html>
<head>
    <title>Welcome</title>
    <link rel="stylesheet" type="text/css" href="snake.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="button.css">
    <link rel="stylesheet" type="text/css" href="table.css">
</head>

<body>

    <%
        if(session.getAttribute("isLogin")==null)
        {
            response.sendRedirect("login.jsp");
        }
    %>

    <h1>Welcome: ${username}</h1>

    <form action="logout" method="post">
        <input type="submit" name="logout" value="Logout">
    </form>

    <table class="content-table" id="all_table">
        <thead>
        <tr>
            <th>id</th>
            <th>userid</th>
            <th>filename</th>
            <th>filepath</th>
            <th>size</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>

    <button id="prv" onclick="prev()">Prev</button>
    <button id="nxt" onclick="next()">Next</button>

    <h2 id="pop"></h2>


</body>
</html>


<script>

        var index = 0;

        function next() {
            index+=5;
            get_files();
        }

        function prev() {
            index-=5;
            get_files();
        }

        function get_files()
        {
            $("#all_table tbody").empty();

            $.ajax({
                url: 'getFiles?id='+${id},
                type: 'get',
                data: {},
                success: function (data) {
                    console.log(data);

                    var max=-1;
                    var wanted="";

                    for(var i=0; i<data.length; i++)
                    {
                        var currentName = data[i]["filename"];
                        var cnt=0;
                        for(var j=0; j<data.length; j++)
                        {
                            if(i!=j)
                            {
                                if(data[j]["filename"]===currentName)
                                    cnt++;
                            }
                        }
                        if(cnt>max)
                        {
                            max=cnt;
                            wanted = currentName;
                        }
                    }

                    console.log("");
                    console.log(wanted);
                    document.getElementById("pop").innerHTML = "This is the most popular file for this user: "+wanted;

                    var len = 5;

                    if(data.length < index+5) {
                        len = data.length;
                        document.getElementById("nxt").disabled = true;
                    }
                    else
                        document.getElementById("nxt").disabled = false;


                    if(index<0)
                        index=0;

                    for(var i=index; i<index+len; i++)
                    {
                        var id = data[i]['id'];
                        var userid = data[i]['userid'];
                        var filename = data[i]['filename'];
                        var filepath = data[i]['filepath'];
                        var size = data[i]['size'];

                        var file = '<tr>'+
                            '<td>'+id+'</td>'+
                            '<td>'+userid+'</td>'+
                            '<td>'+filename+'</td>'+
                            '<td>'+filepath+'</td>'+
                            '<td>'+size+'</td>'+
                                '</tr>';
                            $("#all_table tbody").append(file);
                    }
                }
            });
        }

        $(document).ready(function()
        {
            get_files();
        });

</script>
