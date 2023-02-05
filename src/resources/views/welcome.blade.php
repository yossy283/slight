<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex" />
    <title>slight</title>

    <!--Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    
    <!--Font Awesome5-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <!-- AniCollection.css library -->
    <link rel="stylesheet" href="https://anijs.github.io/lib/anicollection/anicollection.css">

   
</head>
<body>
<!-- 動画背景 -->
<div class="mv">
    <!--  メイン全体を囲うdiv  -->
    <div class="mv-wrap">
        <!--   薄いレイヤー   -->
        <div class="mv-bg"></div>
        <!--   videoタグ   -->
        <video id="video" webkit-playsinline="" playsinline="" muted=""  loop="" poster="images/main.jpg"
            src="video/main_middle.mp4"></video>
        <!--   動画の上に載せるテキスト   -->
        <p class="mv-subtxt">生きづらさを抱えた人のためのコミュニティ</p>
        <p class="mv-txt">slight</p>
        
    </div>
</div>



<header >
    <nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
        <!-- ロゴ -->
        <!--<img src="images/slight_rogo_small.png" alt="" width="30" height="24" class="d-inline-block align-text-top">-->
        <span class="title-txt">slight</span>
        </a>
    </div>
    </nav>
</header>

<!-- VISION -->
<!--うつ病,HSP,発達障害などで悩む方々のためのふれあいの場、一助となる場所を目指したコミュニティです。ここで、自己紹介をさせてください。僕は、現在大学院生。多忙な研究室と変に生真面目な性格からうつ病を患っています。そんな自分が生きるための一つの希望であり、あなたの小さな生きる目的になればいいなと運営しているサイトです。 -->
<section id="sec01">
    <div class="container">
        <h2 class="mt-3" data-anijs="if: scroll, on:window, do: flipInX animated, before: scrollReveal"><span class="title-txt">slight</span>とは</h2>
        <p data-anijs="if: scroll, on:window, do: flipInY animated, before: scrollReveal">
            うつ病,HSP,発達障害などで悩む方々、それに苦しむ方々を助けたい方々のためのふれあいの場、一助となる場所を目指したコミュニティです。私が研究室のストレスで、社会のレールから外れたとき、家族、指導教員の先生、カウンセラー、心療内科の先生など色んな人が助けてくれました。そんな方々のように、微力でも誰かのためになることがしたいと思いました。そんな目的のために作ったサイトです。
        </p>
    </div><!-- /.container -->
</section>
<!-- // VISION -->

<!-- MESSAGE -->
<section id="sec02">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-6 col-sm-12" data-anijs="if: scroll, on:window, do: fadeInLeft animated, before: scrollReveal">
                <img class="img-fluid" src="images/sec02_01.jpg">
            </div>
            <div class="col-md-6 col-sm-12 p-5" data-anijs="if: scroll, on:window, do: fadeInRight animated, before: scrollReveal">
                <h2>生きづらさを抱えたあなたへ</h2>
                <p>世界は理不尽なことで溢れています。周りの人たちは、そんな世界を生きていくのに精一杯で、脱落していった人たちを気に掛ける余裕がないんだと思います。そんな世界で、こんな僕の数少ない味方があなたであり、僕が、このサイトがあなたの味方になれれば嬉しいです。何かつらいことがあったら、僕を、このサイトを思い出してくれたら最高に嬉しいです。
                </p>
            </div>
        </div>
        <div class="row flex-row-reverse">
            <div class="col-md-6 col-sm-12" data-anijs="if: scroll, on:window, do: fadeInRight animated, before: scrollReveal">
                <img class="img-fluid" src="images/sec02_02.jpg">
            </div>
            <div class="col-md-6 col-sm-12 p-5" data-anijs="if: scroll, on:window, do: fadeInLeft animated, before: scrollReveal">
                <h2>昔生きづらかったあなたへ</h2>
                <p>過去のあなたと同じように苦しんでいる方々がいます。そんなあなたの経験が苦しんでいる方々の希望になるかもしれません。宜しければ力を貸していただけると幸いです。</p>
                <h2 class="span-10px">助けたいあなたへ</h2>
                <p>このサイトに集まる方々は自責の念に駆られ、どうしても自分を責めてしまいます。誹謗中傷や強い言葉はやめてください。励ましあっていただけると嬉しいです。</p>
            </div>
        </div>
    </div><!-- /.container -->
</section>
<!-- // MESSAGE -->

<!-- MESSAGE -->
<section id="sec03"  data-anijs="if: scroll, on:window, do: fadeInUp animated, before: scrollReveal">
    <div class="container">
        <h2>サービス</h2>
        <div class="row">
            <div class="col-md-4 col-sm-12">
                <div class="card mb-4">
                    <img class="card-img-top" src="images/sec03_01.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h4 class="card-title">sns</h4>
                        <p class="card-text">あなたが今日なにをしたか是非つぶやいてください。そして、誰かのつぶやきにスタンプを押して励まし合いましょう。僕もあなたも一人じゃありません。</p>
                        <div class="text-center"><a href="#" class="btn btn-dark">近日公開</a></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="card mb-4">
                    <img class="card-img-top" src="images/sec03_02.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h4 class="card-title">掲示板</h4>
                        <p class="card-text">生きづらさで困った時、あなたはどう解決してますか。一つに情報がまとまっているサイトは中々見つかりませんよね。ここさえ見ればいいような掲示板を目指しています。ご協力よろしくお願いします。</p>
                        <div class="text-center"><a href="#" class="btn btn-dark">近日公開</a></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="card mb-4">
                    <img class="card-img-top" src="images/sec03_03.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h4 class="card-title">AI chat</h4>
                        <p class="card-text">生きづらさを誰かに打ち明けたくても、カウンセリングはお金がかかるし、友達に暗い話ばかりしたくないですよね。そんな時はAIに話してみませんか。</p>
                        <div class="text-center"><a href="#" class="btn btn-dark">近日公開</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.container -->
</section>
<!-- // MESSAGE -->

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<!-- AniJS core library -->
<script src="https://anijs.github.io/lib/anijs/anijs-min.js"></script>
<!-- ScrollReveal Helper-->
<script src="https://anijs.github.io/lib/anijs/helpers/scrollreveal/anijs-helper-scrollreveal-min.js"></script>
<!-- Parallax library -->
<script src="js/parallax.min.js"></script>
<!-- スムーズスクロール部分の記述 -->
<script src="js/smoothscroll.js"></script>
<!-- 自動再生部分の記述 -->
<script src="js/videoautoplay.js"></script>


<!--シェアボタン　各自「AddThis」にアクセスしてご自分のシェアボタンを作成してください。-->
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5d91a99854086150"></script>
<script>
    // iPad だけ.wrapの高さを変更する
    $(function () {
        var ua = navigator.userAgent;
        if (ua.indexOf('iPad') > 0) {
            $(".wrap").addClass("height-changed");
        }
    })
</script>
</body>
</html>