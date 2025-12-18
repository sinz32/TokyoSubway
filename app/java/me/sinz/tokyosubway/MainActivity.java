package me.sinz.tokyosubway;

import android.app.Activity;
import android.graphics.Color;
import android.os.Bundle;
import android.support.v4.widget.DrawerLayout;
import android.view.Gravity;
import android.view.View;
import android.webkit.WebSettings;
import android.webkit.WebView;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.LinearLayout;
import android.widget.ListView;


public class MainActivity extends Activity {

    private DrawerLayout drawer;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        LinearLayout layout = new LinearLayout(this);
        layout.setOrientation(1);
        final WebView web = new WebView(this);
        web.loadUrl("안알랴줌");
        WebSettings settings = web.getSettings();
        settings.setJavaScriptEnabled(true);
        settings.setUserAgentString(settings.getUserAgentString()+" AndroidApp/1.0");
        web.setLayoutParams(new LinearLayout.LayoutParams(-1, -1));
        layout.addView(web);
        layout.setLayoutParams(new LinearLayout.LayoutParams(-1, -1));

        drawer = new DrawerLayout(this);
        drawer.addView(layout);
        drawer.addView(createLeftDrawer(web));
        setContentView(drawer);

        getActionBar().setDisplayHomeAsUpEnabled(true);
        getActionBar().setHomeAsUpIndicator(android.R.drawable.menu_full_frame);
    }

    private LinearLayout createLeftDrawer(WebView web) {
        LinearLayout layout = new LinearLayout(this);
        layout.setOrientation(1);

        final String[] lines = {"아사쿠사선", "히비야선", "긴자선", "마루노우치선", "도자이선", "미타선", "난보쿠선", "유라쿠초선", "치요다선", "신주쿠선", "한조몬선", "오에도선", "후쿠토신선", "닫기"};
        final String[] lineIds = {"A", "H", "G", "M", "T", "I", "N", "Y", "C", "S", "Z", "E", "F"};

        ListView list = new ListView(this);
        list.setAdapter(new ArrayAdapter<String>(this, android.R.layout.simple_list_item_1, lines));
        list.setOnItemClickListener((adapterView, view, pos, id) -> {
            if (pos < lineIds.length) {
                web.loadUrl("javascript:loadData('" + lineIds[pos] + "');");
            }
            drawer.closeDrawer(Gravity.LEFT);
        });
        layout.addView(list);
        int pad = dip2px(16);
        list.setPadding(pad, pad, pad, pad);

        DrawerLayout.LayoutParams params = new DrawerLayout.LayoutParams(-1, -1);
        params.gravity = Gravity.LEFT;
        layout.setLayoutParams(params);
        layout.setBackgroundColor(Color.WHITE);

        return layout;
    }

    private int dip2px(int dips) {
        return (int) Math.ceil(dips * this.getResources().getDisplayMetrics().density);
    }

}
