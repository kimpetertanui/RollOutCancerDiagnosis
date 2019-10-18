package com.projects.activities;

import android.support.v7.app.ActionBar;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import com.apps.restaurantfinder.R;
import android.content.Intent;
import android.support.v7.app.AlertDialog;
import android.view.LayoutInflater;
import android.view.View;
import android.view.animation.AnimationUtils;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TextView;

public class WelcomeActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_welcome);

        ImageView logoImage = findViewById(R.id.logo);
        logoImage.startAnimation(AnimationUtils.loadAnimation(this, R.anim.zoom_in));

        TextView welcomeText = findViewById(R.id.welcome_text);
        welcomeText.startAnimation(AnimationUtils.loadAnimation(this, R.anim.zoom_in));

        //display the instructions in an alert dialog
        Button instructionsButton = findViewById(R.id.instructions);
        instructionsButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                AlertDialog.Builder builder = new AlertDialog.Builder(WelcomeActivity.this);
                builder.setView(LayoutInflater.from(getApplicationContext()).inflate(R.layout.layout_custom_dialog, null))
                        .create()
                        .show();
            }
        });

        Button startButton = findViewById(R.id.start);
        startButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(WelcomeActivity.this, HomeActivity.class);
                startActivity(intent);
            }
        });

    }
    // .......start of backpess............
    @Override
    public void onResume() {
        super.onResume();


        ActionBar actionBar = this.getSupportActionBar();
        actionBar.setTitle(R.string.diagnosis);


        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        getSupportActionBar().setDisplayShowHomeEnabled(true);
    }

    @Override
    public boolean onSupportNavigateUp() {
        onBackPressed();
        return true;
    }

    //..............end of backpress....................

}
