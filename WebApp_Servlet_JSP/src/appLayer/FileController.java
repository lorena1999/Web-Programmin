package appLayer;

import dbLayer.MyConnectionProvider;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.util.ArrayList;
import java.util.List;

public class FileController {

    static Connection con;
    static PreparedStatement ps;


    public FileController()
    {

    }

    public List<File> getFilesOfSpecificUser(int userId)
    {
        List<File> files = new ArrayList<>();

        try{
            con = MyConnectionProvider.getCon();
            ps = con.prepareStatement("select * from Files where userid=?");
            ps.setString(1, String.valueOf(userId));

            ResultSet rs = ps.executeQuery();

            while(rs.next())
            {
                int id = Integer.parseInt(rs.getString(1));
                int userid = Integer.parseInt(rs.getString(2));
                String filename = rs.getString(3);
                String filepath = rs.getString(4);
                int size = Integer.parseInt(rs.getString(5));

                File f = new File(id, userid, filename, filepath,size);

                files.add(f);

            }
        }
        catch (Exception e)
        {
            System.out.println(e);
        }
        return files;
    }

}
