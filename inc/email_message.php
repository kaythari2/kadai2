<?php
class EmailMessage {
    public function buildMessage($fromMail, $fromName, $fromInqury) {
        return '<body>'.
        '<div>件名：ジェニオ へのお問合せを受け付けました</div>'.
       ' <div>以下本文：</div>'.
        '<div>==============</div>'.
        '<div>問合わせフォームより、下記ユーザーからお問合せがございました。<br>'.
    '速やかにご対応いただけますよう御願い申し上げます。<br>'.
    '【ご注意】<br>'.
    'このメールは事務局より自動送信させていただいております。<br>'.
    'こちらのメールに返信いただきましてもご対応いたしかねますので<br>'.
    '何卒ご了承くださいませ。<br></div>'.
        '<div>==============</div>'.
        '<div>━お問合せいただいたお客様━━━━━━━━━━━━━━</div>'.
        '<div>お名前：'.$fromName.'</div>'.
        '<div>メールアドレス： '.$fromMail.'</div>'.
        '<div>━お問合せ内容━━━━━━━━━━━━━━━━━━━━</div>'.
        '<div>お問合せ内容 : '.$fromInqury.'</div>'.
        '<div>━━━━━━━━━━━━━━━━━━━━━━━━━━━</div>'.
    '</body>';
    }
}