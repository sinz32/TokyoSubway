package me.sinz.tokyosubway;

import android.app.Activity;
import android.os.Bundle;
import android.webkit.WebSettings;
import android.webkit.WebView;
import android.widget.LinearLayout;

public class MainActivity extends Activity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        LinearLayout layout = new LinearLayout(this);
        layout.setOrientation(1);
        WebView web = new WebView(this);
        web.loadUrl("안알랴줌");
        WebSettings settings = web.getSettings();
        settings.setJavaScriptEnabled(true);
        settings.setUserAgentString(settings.getUserAgentString()+" AndroidApp/1.0");
        web.setLayoutParams(new LinearLayout.LayoutParams(-1, -1));
        layout.addView(web);
        layout.setLayoutParams(new LinearLayout.LayoutParams(-1, -1));
        setContentView(layout);
    }
}