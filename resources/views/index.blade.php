<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="デバイス保険はスマホ、PC、タブレットに対応。月額500円で「破損」「故障」「水濡れ」「紛失」「盗難」を最大15万円まで補償！WEBから申し込み3分！">
    <title>デバイス保険</title>	
    <link rel="icon" href="{{asset('/img/top/favicon.ico')}}" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;700&display=swap" rel="stylesheet">
    <!-- css読み込み（仮） -->
    <link rel="stylesheet" href="{{asset('/css/style.css')}}">
</head>

<body>
    <div class="top-image parallax2"></div>
    <div class="top-parallax">
        <div class="maru_1 parallax1"><img src="{{asset('/img/top/maru_1.png')}}" alt=""></div>
        <div class="maru_2 parallax3"><img src="{{asset('/img/top/maru_2.png')}}" alt=""></div>
        <div class="maru_3 parallax3"><img src="{{asset('/img/top/maru_3.png')}}" alt=""></div>
        <div class="sankaku_2 parallax3"><img src="{{asset('/img/top/sankaku_2.png')}}" alt=""></div>
        <div class="sankaku_1 parallax3"><img src="{{asset('/img/top/sankaku_1.png')}}" alt=""></div>
        <div class="sankaku_3 parallax3"><img src="{{asset('/img/top/sankaku_3.png')}}" alt=""></div>
        <div class="maru_4 parallax4"><img src="{{asset('/img/top/maru_4.png')}}" alt=""></div>
        <div class="sankaku_4"><img src="{{asset('/img/top/sankaku_4.png')}}" alt=""></div>
        <div class="sankaku_5"><img src="{{asset('/img/top/sankaku_5.png')}}" alt=""></div>
        <div class="sikaku_2"><img src="{{asset('/img/top/sikaku_2.png')}}" alt=""></div>
        <div class="sikaku_1"><img src="{{asset('/img/top/sikaku_1.png')}}" alt=""></div>
    </div>
    <div class="top-parallax-sp">
        <div class="sp_maru_1 parallax5"><img src="{{asset('/img/top/sp_maru_1.png')}}" alt=""></div>
        <div class="sp_maru_2 parallax3"><img src="{{asset('/img/top/maru_4.png')}}" alt=""></div>
    </div>
    <div class="top-box">
        <div class="index-img-box">
            <div class="hand-img-box">
                <img src="{{asset('/img/top/hand.png')}}" alt="手の画像">
            </div>
            <div class="fukidashi-img-box">
                <img src="{{asset('/img/top/fukidashi.png')}}" alt="吹き出し画像">
            </div>
            <div class="whoops-img-box">
                <img src="{{asset('/img/top/whoops.png')}}" alt="whoops画像">
            </div>
            <div class="ipnohe-img-box">
                <img src="{{asset('/img/top/ipnohe.png')}}" alt="スマホの画像">
            </div>
        </div>
        <header class="index-header-box">
            <div class="index-header">
                <h1 class="index-h1"><a href="/"><img src="{{asset('/img/top/top-logo.png')}}" alt="ロゴ"></a></h1>
                <div class="index-ham-btn"><span></span><span></span><span></span></div>
                <div class="index-ul-box">
                    <button class="btn-application"><a href="{{url('/notes')}}">Web申し込み</a></button>
                    <ul class="index-ul">
                        <li><a href="#explanation">補償内容</a></li>
                        <li><a href="#description">プランの説明</a></li>
                        <li><a href="#apply">お申し込み方法</a></li>
                        <li><a href="#faq">FAQ</a></li>
                    </ul>
                    <ul class="index-ul-sp">
                        <li><a href="#explanation" class="index-ham-btn">補償内容</a></li>
                        <li><a href="#description" class="index-ham-btn">プランの説明</a></li>
                        <li><a href="#apply" class="index-ham-btn">お申し込み方法</a></li>
                        <li><a href="#faq" class="index-ham-btn">FAQ</a></li>
                    </ul>
                    @auth
                            <button class="btn-login"><a href="{{url('/home')}}">ログイン・マイページ</a></button>
                    @else
                            <button class="btn-login"><a href="{{url('/mypage')}}">ログイン・マイページ</a></button>
                    @endauth
                </div>
                <div class="index-header-btn">
                        @auth
                            <button class="btn-login"><a href="{{url('/home')}}">ログイン・マイページ</a></button>
                        @else
                            <button class="btn-login"><a href="{{url('/mypage')}}">ログイン・マイページ</a></button>
                        @endauth
                        <button class="btn-application"><a href="{{url('/notes')}}">Web申し込み</a></button>
                </div>
            </div>
        </header>
        <main>
            <div class="top-copy-box">
                <div class="top-copy-p">
                    <p>ワンコインでプロテクト</p>
                </div>
                <div class="logo-box">
                    <img src="{{asset('/img/top/logo.png')}}" class="pc-logo" alt="logo画像">
                    <img src="{{asset('/img/top/sp_logo.png')}}" class="sp-logo" alt="logo画像">
                </div>
                <div class="top-explanation">
                    <p>iPhoneもMacbookもiPadも対応</p>
                </div>
            </div>
            <div class="index-sp-btn">
                <div>
                    @auth
                        <button class="btn-login"><a href="{{url('/home')}}">ログイン・マイページ</a></button>
                    @else
                        <button class="btn-login"><a href="{{url('/mypage')}}">ログイン・マイページ</a></button>
                    @endauth
                </div>
                <div>
                    <button class="btn-application"><a href="{{url('/notes')}}">Web申し込み</a></button>
                </div>
            </div>

        </div> 
        <section>
            <div class="index-first-section">
                <h2 class="scroll-fade-row"><img src="{{asset('/img/top/H2.png')}}" alt="タイトル画像"></h2>
                <div class="first-section-img scroll-fade-row">
                    <img src="{{asset('/img/top/anyone.png')}}" alt="デバイス画像">
                    <!--<div class="smartphone-img-box">
                        <div class="smartphone-img">
                            <img src="{{asset('/img/top/sumaho.png')}}" alt="スマホ画像">
                        </div>
                        <div class="img-name">
                            <p>iPhone、Android</p>
                            <p>など</p>
                        </div>
                    </div>
                    <div class="pc-img-box">
                        <div class="pc-img">
                            <img src="{{asset('/img/top/pc.png')}}" alt="パソコン画像">
                        </div>
                        <div class="img-name">
                            <p>Macbook、Windows</p>
                            <p>など</p>
                        </div>
                    </div>
                    <div class="tabret-img-box">
                        <div class="tabret-img">
                            <img src="{{asset('/img/top/tab.png')}}" alt="タブレット画像">
                        </div>
                        <div class="img-name">
                            <p>iPad、タブレット</p>
                            <p>など</p>
                        </div>
                    </div>-->
                </div>
                <div class="contents-box scroll-fade-row">
                    <div class="contents">
                        <div class="check-img">
                            <img src="{{asset('/img/top/ic_check.png')}}" alt="">
                        </div>
                        <div class="contents-p">
                            <p>月額<span class="purple">500円</span>！</p>
                        </div>
                    </div>
                    <div class="contents">
                        <div class="check-img">
                            <img src="{{asset('/img/top/ic_check.png')}}" alt="">
                        </div>
                        <div class="contents-p">
                            <p>年間最大<span class="purple">15万円</span>！</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="explanation">
            <div class="index-second-section">
                <h2 class="scroll-fade-row"><img src="{{asset('/img/top/H2_2.png')}}" alt=""></h2>
                <div class="explanation scroll-fade-row">
                    <p>デバイス保険は、様々なトラブルに対応できるおすすめの保険です。</p>
                </div>
                <div class="problem scroll-fade-row">
                    <div class="problem-top scroll-fade-row">
                        <div class="problem-img-box">
                            <img src="{{asset('/img/top/hason.png')}}" alt="">
                        </div>
                        <div class="problem-img-box">
                            <img src="{{asset('/img/top/kosho.png')}}" alt="">
                        </div>
                    </div>
                    <div class="problem-bottom scroll-fade-row">
                        <div class="problem-img-box">
                            <img src="{{asset('/img/top/hunsitu.png')}}" alt="">
                        </div>
                        <div class="problem-img-box">
                            <img src="{{asset('/img/top/mizu.png')}}" alt="">
                        </div>
                    </div>
                </div>
                <div class="btn-application-box scroll-fade-row">
                    <button class="btn-application"><a href="{{url('/notes')}}">申し込む</a></button>
                </div>
            </div>
        </section>
        <section id="description">
            <div class="index-third-section">
                <h2 class="scroll-fade-row"><img src="{{asset('/img/top/H2_3.png')}}" alt="タイトル画像"></h2>
                <div class="description-img-box scroll-fade-row">
                    <div class="description-top">
                        <div class="description-img">
                            <img src="{{asset('/img/top/Plan_1.png')}}" alt="">
                        </div>
                        <div class="description-img">
                            <img src="{{asset('/img/top/Plan_2.png')}}" alt="">
                        </div>
                    </div>
                    <div class="description-middle">
                        <div class="description-img">
                            <img src="{{asset('/img/top/Plan_3.png')}}" alt="">
                        </div>
                        <div class="description-img">
                            <img src="{{asset('/img/top/Plan_4.png')}}" alt="">
                        </div>
                    </div>
                    <div class="description-bottom">
                        <div class="description-img">
                            <img src="{{asset('/img/top/Plan_5.png')}}" alt="">
                        </div>
                    </div>
                </div>
                <div class="kakko-img scroll-fade-row">
                    <img src="{{asset('/img/top/kakko.png')}}" alt="">
                </div>
                <div class="getigaku-box scroll-fade-row">
                    <p>全て揃って</p>
                    <p><span>月々500円！</span></p>
                    <p>※1端末=1契約までです</p>
                </div>
                <div class="scroll-fade-row">
                    <div class="contents-box">
                        <div class="passage">
                            <p>【補償内容】</p>
                            <p>修理費用保険金、盗難・紛失補償</p>
                            <p>契約者が被保険者の所有または使用している通信端末に対し一台を定めて契約した修理費用保険金額を年間の上限額として、修理費用と盗難、紛失を補償します。
                                補償の対象とするのは、破損、汚損、故障、水濡れによって補償対象通信機器が損傷し、被保険者が修理費用を負担した場合、盗難・紛失によって生じた補償対象
                                通信機器の損害で、実損填補および不正防止の考え方から、修理費用は実際にかかった修理費用、全損時は保険の対象（目的）の30％を上限とします。</p>
                            <p>【保険金額】</p>
                            <p>この保険の保険金額は10,000円から300,000円とします。</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="apply">
            <div class="index-fouth-section">
                <h2 class="scroll-fade-row"><img src="{{asset('/img/top/H2_4.png')}}" alt="タイトル画像"></h2>
                <p class="apply-chatch scroll-fade-row">デバイスほけんなら簡単に登録することができます！</p>
                <div class="apply-img scroll-fade-row">
                    <img src="{{asset('/img/top/apply.png')}}" alt="">
                </div>
                <div class="btn-application-box scroll-fade-row">
                    <button class="btn-application"><a href="{{url('/notes')}}">申し込む</a></button>
                </div>
            </div>
        </section>
        <section class="fifth-section-back" id="faq">
            <div class="index-fifth-section">
                <h2><img src="{{asset('/img/top/H2_5.png')}}" alt=""></h2>
                <div class="scroll-fade-row">
                    <div class="faq-wrapper">
                        <div class="faq-box">
                            <div class="faq-q">
                                <div class="q-contents">
                                    <div><span class="lettar-q">Q</span><span class="question">お申し込み方法はどのような流れになりますか？</span></div>
                                    <div class="open-icon">
                                        <div class="plus-img"><img src="{{asset('/img/top/plus.png')}}" alt=""></div>
                                        <div class="minus-img"><img src="{{asset('/img/top/minus.png')}}" alt=""></div>
                                    </div>
                                </div>
                            </div>
                            <div class="faq-a apply-a">
                                <div class="anser-box">
                                    <span class="lettar-a">A</span><p class="anser">登録は簡単です。端末・必要情報・クレジットカードの登録の流れになります。</p>
                                </div>
                                <div class="flow-box">
                                    <div class="camera-box">
                                        <p>STEP1</p>
                                        <div class="camera-img"><img src="{{asset('/img/top/camera.png')}}" alt=""></div>
                                        <p>登録したい端末の写真を撮る</p>
                                    </div>
                                    <div class="arrow-img"><img src="{{asset('/img/top/yazirusi.png')}}" alt=""></div>
                                    <div class="input-box">
                                        <p>STEP2</p>
                                        <div class="input-img"><img src="{{asset('/img/top/nyuryoku.png')}}" alt=""></div>
                                        <p>必要情報の入力</p>
                                    </div>
                                    <div class="arrow-img"><img src="{{asset('/img/top/yazirusi.png')}}" alt=""></div>
                                    <div class="card-box">
                                        <p>STEP3</p>
                                        <div class="card-img"><img src="{{asset('/img/top/card.png')}}" alt=""></div>
                                        <p>クレジットカードの入力</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="faq-wrapper">
                        <div class="faq-box">
                            <div class="faq-q">
                                <div class="q-contents">
                                    <div><span class="lettar-q">Q</span><span class="question">未成年でも契約できますか？</span></div>
                                    <div class="open-icon">
                                        <div class="plus-img"><img src="{{asset('/img/top/plus.png')}}" alt=""></div>
                                        <div class="minus-img"><img src="{{asset('/img/top/minus.png')}}" alt=""></div>
                                    </div>
                                </div>
                            </div>
                            <div class="faq-a underage-a">
                                <div class="anser-box"><span class="lettar-a">A</span><p class="anser">満18歳からご契約いただけます。17歳以下のお客様は保護者の方を契約者としてお申し込みをお願いいたします。</p></div>
                            </div>
                        </div>
                    </div>
                    <div class="faq-wrapper">
                        <div class="faq-box">
                            <div class="faq-q">
                                <div class="q-contents">
                                    <div><span class="lettar-q">Q</span><span class="question">人で複数契約できますか？</span></div>
                                    <div class="open-icon">
                                        <div class="plus-img"><img src="{{asset('/img/top/plus.png')}}" alt=""></div>
                                        <div class="minus-img"><img src="{{asset('/img/top/minus.png')}}" alt=""></div>
                                    </div>
                                </div>
                            </div>
                            <div class="faq-a multiple-a">
                                <div class="anser-box"><span class="lettar-a">A</span><p class="anser">複数端末をお持ちの方は、申込後マイページからそれぞれの端末を登録することで契約が可能です。</p></div>
                            </div>
                        </div>
                    </div>
                    <div class="faq-wrapper">
                        <div class="faq-box">
                            <div class="faq-q">
                                <div class="q-contents">
                                    <div><span class="lettar-q">Q</span><span class="question">法人契約はできますか？</span></div>
                                    <div class="open-icon">
                                        <div class="plus-img"><img src="{{asset('/img/top/plus.png')}}" alt=""></div>
                                        <div class="minus-img"><img src="{{asset('/img/top/minus.png')}}" alt=""></div>
                                    </div>
                                </div>
                            </div>
                            <div class="faq-a corporation-a">
                                <div class="anser-box"><span class="lettar-a">A</span><p>法人契約も可能です。ただし被保険者は個人での登録をお願いいたします。</p></div>
                            </div>
                        </div>
                    </div>
                    <div class="faq-wrapper">
                        <div class="faq-box">
                            <div class="faq-q">
                                <div class="q-contents">
                                    <div><span class="lettar-q">Q</span><span class="question">契約者とスマートフォンの使用者が違う場合でも加入できますか？</span></div>
                                    <div class="open-icon">
                                        <div class="plus-img"><img src="{{asset('/img/top/plus.png')}}" alt=""></div>
                                        <div class="minus-img"><img src="{{asset('/img/top/minus.png')}}" alt=""></div>
                                    </div>
                                </div>
                            </div>
                            <div class="faq-a different-a">
                                <div class="anser-box"><span class="lettar-a">A</span><p>ご加入いただけます。使用者が違う場合は、お申込み後のマイページから端末登録を行う際に、「使用者」の欄に実際のご使用者さまのお名前のご入力をお願いいたします。</p></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <footer class="index-footer">
        <div class="footer-box">
            <div class="footer-logo"><p>デバイス保険</p></div>
            <ul>
                <li><a href="{{url('/privacypolicy')}}">プライバシーポリシー</a><span>></span></li>
                <li><a href="{{url('/terms')}}">約款</a><span>></span></li>
                <li><a href="/" class="coporate">コーポレートサイト</a><span>></span></li>
            </ul>
            <p class="copyright"><small>Copyright 2023- Device HOKEN., LTD. ALL RIGHTS RESERVED.</small></p>
        </div>
    </footer>
<!--    <form action="/ChargeController" method="post" enctype="multipart/form-data">
        @csrf
        <p>
            <input type="file" name="datafile" capture="environment" accept="image/*">
        </p>
        <p>
            <input type="submit" value="送信する">
        </p>
    </form>

    <div class="cookie-consent">
        <div class="cookie-text">
            当社のウェブサイトは、利便性、品質維持・向上を目的に、Cookieを使用しております。
            詳しくは、クッキーポリシーをご参照ください。
            Cookieの利用に同意頂ける場合は、「同意する」ボタンを押してください。「<a href="#privacy-policy">プライバシーポリシー</a>」をご覧ください。</div>
            <div class="cookie-flex">
                <div class="cookie-permission">Cookieを許可する</div>
                <div class="cookie-rejection">拒否する</div>
            </div>
        </div>
    </div>-->
    <script src="https://code.jquery.com/jquery-3.6.2.min.js"integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA="crossorigin="anonymous"></script>
    <style>
            *{
        margin: 0;
        padding: 0;
        }
        .cookie-consent {
            align-items: center;
            margin-top: 30%;
            width: 100%;
            font-size: 12px;
            background: rgb(7, 7, 7);
            padding: 1.2em;
            box-sizing: border-box;
            border-radius: 4px;
        }
        .cookie-text {
            color: #fff;
            width: 100%;
        }
        .cookie-flex{
            width: 90%;
            display: flex;
            justify-content: space-around;
        }
        .cookie-permission {
            color: #000;
            background: #fff;
            padding: .5em 1.5em;
            border: solid 1px #000;
            border-radius: 4px;
        }
        
        .cookie-rejection {
            color: #000;
            background: #fff;
            padding: .5em 1.5em;
            border: solid 1px #000;
            border-radius: 4px;
        }
    </style>
    
    <script type="text/javascript" charset="UTF-8">
        document.cookie = 'agency=' + ((new URL(document.location)).searchParams).get("utm_campaign");
        (function (config) {  
            config.urlCapture = { 
                filterURLQuery: ["utm_campaign"]
            }
        })(window['adrum-config'] || (window['adrum-config'] = {}));

        var url = new URL(window.location.href);
        history.replaceState('', '', url.pathname);
        
    </script>

    <script>
        
        //背景画像パララックス設定
        jQuery( window ).bind( 'scroll', function() {
            scrolled = jQuery( window ).scrollTop();
            weight1 = 0.05;
            weight2 = 0.03;
            weight3 = 0.02;
            weight4 = 0.01;

            jQuery( '.parallax1' ).css( 'top', 0 + scrolled * weight1 + 'px' );
            jQuery( '.parallax2' ).css( 'top', 50 - scrolled * weight2 + 'px' );
            jQuery( '.parallax3' ).css( 'bottom', 40 + scrolled * weight1 + 'px' );
            jQuery( '.parallax4' ).css( 'bottom', 0 - scrolled * weight3 + 'px' );
            jQuery( '.parallax5' ).css( 'top', 0 + scrolled * weight4 + 'px' );


        });


        //ハンバーガーメニュー
        $(".index-ham-btn").click(function () {
            $('.index-ham-btn').toggleClass('active');
            $('.index-ul-box').toggleClass("active");
        });


        //FAQアコーディオンメニュー
        $(function(){
            $('.faq-a:first').css("display", "block");
            $('.faq-q:first').addClass('active');
            $('.faq-q').click(function(){
                $(this).next('.faq-a:not(:animated)').slideToggle();
                $(this).toggleClass("active");
            });
        });

        $(function(){

        var effect_btm = 300; // 画面下からどの位置でフェードさせるか(px)
        var effect_move = 50; // どのぐらい要素を動かすか(px)
        var effect_time = 800; // エフェクトの時間(ms) 1秒なら1000

        //親要素と子要素のcssを定義
        $('.scroll-fade-row').css({
            opacity: 0
        });
        $('.scroll-fade-row').children().each(function(){
            $(this).css({
                opacity: 0,
                transform: 'translateY('+ effect_move +'px)',
                transition: effect_time + 'ms'
            });
        });

        // スクロールまたはロードするたびに実行
        $(window).on('scroll load', function(){
            var scroll_top = $(this).scrollTop();
            var scroll_btm = scroll_top + $(this).height();
            var effect_pos = scroll_btm - effect_btm;

            //エフェクトが発動したとき、子要素をずらしてフェードさせる
            $('.scroll-fade-row').each( function() {
                var this_pos = $(this).offset().top;
                if ( effect_pos > this_pos ) {
                    $(this).css({
                        opacity: 1,
                        transform: 'translateY(0)'
                    });
                    $(this).children().each(function(i){
                        $(this).delay(100 + i*200).queue(function(){
                            $(this).css({
                                opacity: 1,
                                transform: 'translateY(0)'
                            }).dequeue();
                        });
                    });
                }
            });
        });

        });

    </script>
    <script>
        lazyload();
    </script>
</body>
</html>
