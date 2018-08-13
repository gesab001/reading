package net.giovanni.reading;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;

public class MainActivity extends AppCompatActivity {

    Button button1;
    Button button2;
    Button button3;
    Button back;
    Button next;
    TextView textView;
    String[] words = new String[]{"bible", "jesus", "god", "holy spirit", "genesis", "exodus",
            "man", "woman", "male", "female"};
    int count = 0;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        button1 = findViewById(R.id.button1);
        button2 = findViewById(R.id.button2);
        button3 = findViewById(R.id.button3);
        back = findViewById(R.id.back);
        next = findViewById(R.id.next);
        textView = findViewById(R.id.textview);

        next.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                button1.setText(words[count]);
                button2.setText(words[count+1]);
                button3.setText(words[count+2]);
                count = count + 1;
                if (count>=words.length-3){
                    count = 0;
                }
            }
        });


    }
}
