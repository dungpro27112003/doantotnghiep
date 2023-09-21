<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{{ $title }}</title>

<link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<link rel="stylesheet" href="/template/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">

<link rel="stylesheet" href="/template/admin/dist/css/adminlte.min.css?v=3.2.0">
<script defer="" referrerpolicy="origin"
    src="/cdn-cgi/zaraz/s.js?z=JTdCJTIyZXhlY3V0ZWQlMjIlM0ElNUIlNUQlMkMlMjJ0JTIyJTNBJTIyQWRtaW5MVEUlMjAzJTIwJTdDJTIwTG9nJTIwaW4lMjIlMkMlMjJ4JTIyJTNBMC45ODY3NDMyODg4NjQyMTQ3JTJDJTIydyUyMiUzQTE5MjAlMkMlMjJoJTIyJTNBMTA4MCUyQyUyMmolMjIlM0E5NjMlMkMlMjJlJTIyJTNBMTkyMCUyQyUyMmwlMjIlM0ElMjJodHRwcyUzQSUyRiUyRmFkbWlubHRlLmlvJTJGdGhlbWVzJTJGdjMlMkZwYWdlcyUyRmV4YW1wbGVzJTJGbG9naW4uaHRtbCUyMiUyQyUyMnIlMjIlM0ElMjJodHRwcyUzQSUyRiUyRnd3dy5nb29nbGUuY29tJTJGJTIyJTJDJTIyayUyMiUzQTI0JTJDJTIybiUyMiUzQSUyMlVURi04JTIyJTJDJTIybyUyMiUzQS00MjAlMkMlMjJxJTIyJTNBJTVCJTVEJTdE">
</script>
<meta name="csrf-token" content="{{ csrf_token() }}">
<style >
    .hidden{
        display: none;
    }
</style>
@yield('head')
<script nonce="fa23df80-f7bd-4e9e-b88e-260b43167161">
    (function(w, d) {
        ! function(U, V, W, X) {
            U[W] = U[W] || {};
            U[W].executed = [];
            U.zaraz = {
                deferred: [],
                listeners: []
            };
            U.zaraz.q = [];
            U.zaraz._f = function(Y) {
                return async function() {
                    var Z = Array.prototype.slice.call(arguments);
                    U.zaraz.q.push({
                        m: Y,
                        a: Z
                    })
                }
            };
            for (const $ of ["track", "set", "debug"]) U.zaraz[$] = U.zaraz._f($);
            U.zaraz.init = () => {
                var ba = V.getElementsByTagName(X)[0],
                    bb = V.createElement(X),
                    bc = V.getElementsByTagName("title")[0];
                bc && (U[W].t = V.getElementsByTagName("title")[0].text);
                U[W].x = Math.random();
                U[W].w = U.screen.width;
                U[W].h = U.screen.height;
                U[W].j = U.innerHeight;
                U[W].e = U.innerWidth;
                U[W].l = U.location.href;
                U[W].r = V.referrer;
                U[W].k = U.screen.colorDepth;
                U[W].n = V.characterSet;
                U[W].o = (new Date).getTimezoneOffset();
                if (U.dataLayer)
                    for (const bg of Object.entries(Object.entries(dataLayer).reduce(((bh, bi) => ({
                            ...bh[1],
                            ...bi[1]
                        })), {}))) zaraz.set(bg[0], bg[1], {
                        scope: "page"
                    });
                U[W].q = [];
                for (; U.zaraz.q.length;) {
                    const bj = U.zaraz.q.shift();
                    U[W].q.push(bj)
                }
                bb.defer = !0;
                for (const bk of [localStorage, sessionStorage]) Object.keys(bk || {}).filter((bm => bm
                    .startsWith("_zaraz_"))).forEach((bl => {
                    try {
                        U[W]["z_" + bl.slice(7)] = JSON.parse(bk.getItem(bl))
                    } catch {
                        U[W]["z_" + bl.slice(7)] = bk.getItem(bl)
                    }
                }));
                bb.referrerPolicy = "origin";
                bb.src = "/cdn-cgi/zaraz/s.js?z=" + btoa(encodeURIComponent(JSON.stringify(U[W])));
                ba.parentNode.insertBefore(bb, ba)
            };
            ["complete", "interactive"].includes(V.readyState) ? zaraz.init() : U.addEventListener(
                "DOMContentLoaded", zaraz.init)
        }(w, d, "zarazData", "script");
    })(window, document);
</script>
