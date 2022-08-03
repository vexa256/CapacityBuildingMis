@include('certificates.header')
<div id="page-container">
    <div id="pf1" class="pf w0 h0" data-page-no="1">
        <div class="pc pc1 w0 h0"><img class="bi x0 y0 w0 h0" alt="" src="{{asset('assets/cert/bg1.png')}}" />
            <div class="c x0 y1 w1 h1">
                <div class="t m0 x1 h2 y2 ff1 fs0 fc0 sc0 ls0 ws0">T<span class="_ _0"></span>his is to certif<span class="_ _0"></span>y that<span class="_ _0"></span> </div>
                <div class="t m0 x2 h2 y3 ff1 fs0 fc0 sc0 ls0 ws0">Ha<span class="_ _1"></span>s succes<span class="_ _2"></span>sfully comple<span class="_ _2"></span>ted a training in<span class="_ _2"></span> </div>
                <div class="t m0 x3 h3 y4 ff2 fs1 fc1 sc1 ls0 ws0">{{ $CourseName }}<span class="_ _0"></span></div>
                <div class="t m0 x4 h4 y5 ff2 fs2 fc1 sc1 ls0 ws0">({{ $CEU }} CEUS<span class="_ _0"></span>) </div>
                <div class="t m0 x5 h2 y6 ff1 fs0 fc0 sc0 ls0 ws0">at the N<span class="_ _2"></span>ational T<span class="_ _5"></span>uber<span class="_ _5"></span>culosis R<span class="_ _5"></span>ef<span class="_ _2"></span>er<span class="_ _2"></span>ence <span class="_ _5"></span>Laboratory Kampala Uganda
                    <span class="_ _0"></span> </div>
                <div style="text-align: center" class="t m0 x6 h2 y7 ff1 fs0 fc0 sc0 ls0 ws0"><span class="_ _5"></span>From <span class="_ _5"></span><span class="_ _0"></span>{{ $From }} to {{ $To }} <span class="_ _2"></span> and attained a Certificate of <span class="">{{ $CertType }}</span> </div>
                <div class="t m0 x7 h5 y8 ff3 fs0 fc0 sc1 ls0 ws0">Prof<span class="_ _5"></span>. Moses Joloba </div>
                <div class="t m0 x8 h5 y9 ff3 fs0 fc0 sc1 ls0 ws0">Laboratory <span class="_ _2"></span>Director<span class="_ _4"></span>, Uganda <span class="_ _2"></span>SRL </div>
                <div class="t m0 x9 h3 ya ff4 fs1 fc1 sc1 ls0 ws0" style="margin-left:70px">{{ strtoupper(Auth::user()->name) }}<span class="_ _4"></span></div>
                <div class="t m0 xa h6 yb ff4 fs3 fc0 sc1 ls0 ws0">CER<span class="_ _6"></span>TIFICA<span class="_ _7"></span>TE<span class="fs4"> </span></div>
                <div class="t m0 xb h7 yc ff4 fs4 fc0 sc1 ls0 ws0">OF CO<span class="_ _2"></span>MPLETION </div>
                <div class="t m0 xc h5 yd ff4 fs0 fc0 sc1 ls0 ws0">{{ $CertNumber }}</div>


                <div class="t m0 xe h5 y11 ff2 fs0 fc0 sc1 ls0 ws0">(<span class="fs5">See overle<span class="_ _0"></span>af for training modules and certi&amp;<span class="_ _0"></span>cation crit<span class="_ _0"></span>eria<span class="_ _1"></span></span>) </div>
            </div>
        </div>
        <div class="pi" data-data='{"ctm":[1.000000,0.000000,0.000000,1.000000,0.000000,0.000000]}'></div>
    </div>

    @include('certificates.body1')

    @include('certificates.footer')
