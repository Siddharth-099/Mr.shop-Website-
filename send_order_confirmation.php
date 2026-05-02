<?php
// 1. ઓર્ડર અને યુઝરની વિગતો (તમારે આ ડેટાબેઝમાંથી લેવી પડશે)
// આ ઉદાહરણ માટે અમે ડમી ડેટા (Dummy Data) નો ઉપયોગ કરીશું:
$user_name = "અજય પટેલ";
$user_email = "ajay.patel@example.com"; // યુઝરનું સાચું ઈમેલ એડ્રેસ
$order_id = "MARI-2025-1025";
$order_date = date("d/m/Y");
$total_amount = "2500.00"; 
$shipping_address = "ફ્લેટ નં. 501, કલ્પતરૂ એપાર્ટમેન્ટ, અમદાવાદ - 380015";

// 2. ઈમેલનું કન્ટેન્ટ (HTML અને In-line CSS)
// ઈમેલ ક્લાયન્ટ્સ માટે Tables અને In-line CSS નો ઉપયોગ કરવો જરૂરી છે.

$html_body = '
    <html>
    <head>
        <style>
            /* Basic Reset/Styles */
            body { font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0; }
            .container { max-width: 600px; margin: 20px auto; background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
            .header { background-color: #4CAF50; color: white; padding: 20px; text-align: center; }
            .content { padding: 30px; }
            .footer { background-color: #eee; color: #777; padding: 15px; text-align: center; font-size: 12px; }
            .order-summary { border: 1px solid #ddd; padding: 15px; margin-top: 20px; border-radius: 4px; }
            .button { background-color: #2196F3; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; display: inline-block; margin-top: 15px; }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h2>તમારો ઓર્ડર સફળતાપૂર્વક કન્ફર્મ! 🎉</h2>
            </div>
            <div class="content">
                <p><strong>પ્રિય ' . $user_name . ',</strong></p>
                <p>તમારી ખરીદી માટે તમારો ખૂબ ખૂબ આભાર! તમારો ઓર્ડર સફળતાપૂર્વક પ્લેસ થઈ ગયો છે.</p>

                <div class="order-summary">
                    <p style="font-size: 18px; color: #4CAF50; margin: 0 0 10px 0;"><strong>ઓર્ડર નંબર: ' . $order_id . '</strong></p>
                    <p style="margin: 5px 0;">ઓર્ડરની તારીખ: ' . $order_date . '</p>
                    <hr style="border-top: 1px solid #eee;">
                    <p style="margin: 5px 0;">કુલ રકમ: <strong>₹ ' . $total_amount . '</strong></p>
                    <hr style="border-top: 1px solid #eee;">
                    <p style="margin: 5px 0;">શિપિંગ સરનામું: <br><strong>' . nl2br($shipping_address) . '</strong></p>
                </div>
                
                <p style="margin-top: 25px;">અમે તમારા ઓર્ડર પર ઝડપથી કામ કરી રહ્યા છીએ અને ટૂંક સમયમાં તમને શિપિંગ કન્ફર્મેશન ઈમેલ મોકલીશું.</p>
                
                <p style="text-align: center;">
                    <a href="http://yourwebsite.com/track_order.php?id=' . $order_id . '" class="button">ઓર્ડર ટ્રેક કરો</a>
                </p>

                <p style="margin-top: 20px;">જો કોઈ પ્રશ્ન હોય, તો કૃપા કરીને અમારો સંપર્ક કરો.</p>
            </div>
            <div class="footer">
                <p>&copy; ' . date("Y") . ' તમારી વેબસાઇટનું નામ. બધા અધિકારો સુરક્ષિત.</p>
            </div>
        </div>
    </body>
    </html>
';

// 3. ઈમેલ મોકલવા માટે PHP mail() ફંક્શનનો ઉપયોગ

// Email Headers (આ HTML ઈમેલ માટે જરૂરી છે)
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= "From: તમારી વેબસાઇટનું નામ <no-reply@yourwebsite.com>" . "\r\n"; // અહીં તમારું વેબસાઇટ ડોમેન વાપરો

$subject = "તમારા ઓર્ડર #" . $order_id . " ની કન્ફર્મેશન રસીદ";

// mail() ફંક્શનનો ઉપયોગ કરીને ઈમેલ મોકલો
if (mail($user_email, $subject, $html_body, $headers)) {
    // ઈમેલ સફળતાપૂર્વક મોકલાયો
    // તમે યુઝરને સફળતાનો મેસેજ આપી શકો છો.
    // echo "ઓર્ડર કન્ફર્મેશન ઈમેલ સફળતાપૂર્વક મોકલાયો છે.";
} else {
    // ઈમેલ મોકલવામાં નિષ્ફળતા
    // echo "ઈમેલ મોકલી શકાયો નહીં. કૃપા કરીને સર્વર સેટિંગ્સ તપાસો.";
}

?>