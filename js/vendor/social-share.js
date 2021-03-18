/*
	SocialShare
*/

/*
Plugin Name: socialShare
Version: 1.0
Plugin URI: https://github.com/tolgaergin/social
Description: To share any page with 46 icons 
Author: Tolga Ergin
Author URI: http://tolgaergin.com
Designer: Gökhun Güneyhan
Designer URI: http://gokhunguneyhan.com
*/

/* PLUGIN USAGE */
/* 
$('#clickable').socialShare({
      social: 'blogger,delicious,digg,facebook,friendfeed,google,linkedin,myspace,pinterest,reddit,stumbleupon,tumblr,twitter,windows,yahoo'
    });
*/
! function(e) {
    e.fn.extend({
        socialShare: function(t) {
            function a() {
                if (window.getSelection) return window.getSelection();
                if (document.getSelection) return document.getSelection();
                var e = document.selection && document.selection.createRange();
                return e.text ? e.text : !1
            }

            function r(t, a, r) {
                var i = e(t);
                i.each(function(t) {
                    e(this).delay(t * a).fadeTo(a, r)
                })
            }

            function i() {
                for (var a = {
                        blogger: {
                            text: "Blogger",
                            className: "blogger",
                            url: "http://www.blogger.com/blog_this.pyra?t=&amp;u={u}&amp;n={t}",
                            da: ""
                        },
                        delicious: {
                            text: "Delicious",
                            className: "delicious",
                            url: "http://del.icio.us/post?url={u}&amp;title={t}",
                            da: ""
                        },
                        digg: {
                            text: "Digg",
                            className: "aDigg",
                            url: "http://digg.com/submit?phase=2&amp;url={u}&amp;title={t}",
                            da: ""
                        },
                        facebook: {
                            text: "Facebook",
                            className: "facebook",
                            url: "http://www.facebook.com/sharer.php?u={u}",
                            da: ""
                        },
                        friendfeed: {
                            text: "FriendFeed",
                            className: "friendFeed",
                            url: "http://friendfeed.com/share?url={u}&amp;title={t}",
                            da: ""
                        },
                        google: {
                            text: "Google+",
                            className: "googleplus",
                            url: "https://plus.google.com/share?url={u}",
                            da: ""
                        },
                        linkedin: {
                            text: "LinkedIn",
                            className: "linkedin",
                            url: "http://www.linkedin.com/shareArticle?mini=true&amp;url={u}&amp;title={t}&amp;ro=false&amp;summary=&amp;source=",
                            da: ""
                        },
                        myspace: {
                            text: "MySpace",
                            className: "myspace",
                            url: "http://www.myspace.com/Modules/PostTo/Pages/?u={u}&amp;t={t}",
                            da: ""
                        },
                        pinterest: {
                            text: "Pinterest",
                            className: "pinterest",
                            url: "http://pinterest.com/pin/create/button/?url={u}&amp;media={m}&amp;description={t}",
                            da: ""
                        },
                        vk: {
                            text: "VKontakte",
                            className: "vk",
                            url: "http://vk.com/share.php?url={u}&amp;title={t}&amp;image={m}",
                            da: ""
                        },
                        reddit: {
                            text: "Reddit",
                            className: "reddit",
                            url: "http://reddit.com/submit?url={u}&amp;title={t}",
                            da: ""
                        },
                        stumbleupon: {
                            text: "StumbleUpon",
                            className: "stumbleUpon",
                            url: "http://www.stumbleupon.com/submit?url={u}&amp;title={t}",
                            da: ""
                        },
                        tumblr: {
                            text: "Tumblr",
                            className: "tumblr",
                            url: "http://www.tumblr.com/share/link?url={u}&name={t}&description={t}",
                            da: ""
                        },
                        twitter: {
                            text: "Twitter",
                            className: "twitter",
                            url: "http://twitter.com/home?status={t}%20{u}",
                            da: ""
                        },
                        windows: {
                            text: "Windows",
                            className: "windows",
                            url: "http://profile.live.com/badge?url={u}",
                            da: ""
                        },
                        yahoo: {
                            text: "Yahoo",
                            className: "yahoo",
                            url: "http://bookmarks.yahoo.com/toolbar/savebm?opener=tb&amp;u={u}&amp;t={t}",
                            da: ""
                        },
                        whatsapp: {
                            text: "WhatsApp",
                            className: "whatsapp",
                            url: "whatsapp://send?text={u}",
                            da: "data-action='share/whatsapp/share'"
                        }
                    }, r = t.social.split(","), i = "", o = 0; o <= r.length - 1; o++) a[r[o]].url = a[r[o]].url.replace("{t}", encodeURIComponent(t.title)).replace("{u}", encodeURI(t.shareUrl)).replace("{d}", encodeURIComponent(t.description)).replace("{m}", encodeURI(t.mediaUrl)), i += '<li class="' + a[r[o]].className + '"><a href="' + a[r[o]].url + '" target="_blank" ' + a[r[o]].da + "></a><span>" + a[r[o]].text + "</span></li>";
                e("body").append(d + i + u)
            }

            function o(t) {
                t.blur && e("body").children().removeClass("blurred"), e(".arthrefSocialShare").find(".overlay").removeClass("active"), e(".arthrefSocialShare").find("ul").removeClass("active"), setTimeout(function() {
                    e(".arthrefSocialShare").find(".overlay").css("display", "none"), e(".arthrefSocialShare").remove()
                }, 300)
            }
            var l = {
                social: "",
                title: document.title,
                shareUrl: window.location.href,
                description: e('meta[name="description"]').attr("content"),
                mediaUrl: e(".social-sharing").attr("data-shareimg"),
                animation: "launchpad",
                chainAnimationSpeed: 100,
                whenSelect: !1,
                selectContainer: "body",
                blur: !1
            };
            if (e("#page-wrap").hasClass("mc-dark")) var s = "sdark";
            else var s = "";
            var t = e.extend(!0, l, t),
                n = e(".box-share-master-container").attr("data-name"),
                c = e(".social-sharing").attr("data-name"),
                d = '<div class="arthref arthrefSocialShare ' + s + '"><div class="overlay ' + t.animation + '"><div class="icon-container"><div class="centered"><div class="share-title"><h4>' + n + "</h4><h1>" + c + '</h1></div><ul class="social-icons">',
                u = "</ul></div></div></div></div>";
            return this.each(function() {
                var l = t,
                    s = e(this);
                l.whenSelect && e(l.selectContainer).mouseup(function(e) {
                    var r = a();
                    r && (r = new String(r).replace(/^\s+|\s+$/g, "")) && (t.title = r)
                }), s.click(function() {
                    i(), l.blur && (e(".arthrefSocialShare").find(".overlay").addClass("opaque"), e("body").children().not(".arthref, script").addClass("blurred")), e(".arthrefSocialShare").find(".overlay").css("display", "block"), setTimeout(function() {
                        e(".arthrefSocialShare").find(".overlay").addClass("active"), e(".arthrefSocialShare").find("ul").addClass("active"), "chain" == l.animation && r(e(".arthrefSocialShare").find("li"), l.chainAnimationSpeed, "1")
                    }, 0)
                }), e(document).on("click touchstart", ".arthrefSocialShare .overlay", function(e) {
                    o(l)
                }), e(document).on("keydown", function(e) {
                    27 == e.keyCode && o(l)
                }), e(document).on("click touchstart", ".arthrefSocialShare li", function(e) {
                    e.stopPropagation()
                })
            })
        }
    })
}(jQuery);