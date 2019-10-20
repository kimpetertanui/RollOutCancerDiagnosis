package com.projects.activities;

import android.content.Intent;
import android.support.v7.app.ActionBar;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;

import com.apps.restaurantfinder.R;

public class DonateActivity extends AppCompatActivity {
    private Button  btnDonate;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_donate);

        btnDonate=(Button) findViewById(R.id.pay);



        btnDonate.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent =new Intent(DonateActivity.this,MpesaActivity.class);
                startActivity(intent);
            }
        });
    }

    // .......start of backpess............
    @Override
    public void onResume() {
        super.onResume();


        ActionBar actionBar = this.getSupportActionBar();
        actionBar.setTitle(R.string.donate);


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
