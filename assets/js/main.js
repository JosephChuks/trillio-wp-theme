"use strict";
const url = new URL(window.location.href);
const language = url.searchParams.get("locale");

if (language === "fr") {
  doGTranslate("en|fr");
}

if (language === "ar") {
  doGTranslate("en|ar");
}
