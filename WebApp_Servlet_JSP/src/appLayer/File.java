package appLayer;

import com.google.gson.annotations.SerializedName;
import dbLayer.MyConnectionProvider;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.util.ArrayList;
import java.util.List;

public class File {

    static Connection con;
    static PreparedStatement ps;

    @SerializedName("id")
    private int id;

    @SerializedName("userid")
    private int userid;

    @SerializedName("filename")
    private String filename;

    @SerializedName("filepath")
    private String filepath;

    @SerializedName("size")
    private int size;

    public File()
    {

    }

    public File(int id, int userid, String filename, String filepath, int size)
    {
        this.id = id;
        this.userid = userid;
        this.filename = filename;
        this.filepath = filepath;
        this.size = size;
    }

    public int getUserid()
    {
        return this.userid;
    }

    public String getFilename()
    {
        return this.filename;
    }

    public String getFilepath()
    {
        return this.filepath;
    }

    public int getSize()
    {
        return this.size;
    }

    public String toString()
    {
        return "Asset: {id="+id+", user_id="+userid+", filename="+filename+", filepath="+filepath+", size="+size+"}";
    }
}
