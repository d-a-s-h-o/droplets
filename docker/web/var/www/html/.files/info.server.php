<?php
 

error_reporting(0);
ini_set('display_errors', 0);
$manager = 'https://mgmt.sokka.io/';
$private = trim(file_get_contents('/var/www/dump/files.hostname'));
$public = trim(file_get_contents('/var/www/html/public.url'));
$admin = 'https://chat.sokka.io/';
$dbhost = trim(file_get_contents('/var/www/.dbhost.txt'));
$dbport = trim(file_get_contents('/var/www/.dbport.txt'));
$dbname = trim(file_get_contents('/var/www/.dbname.txt'));
$dbuser = trim(file_get_contents('/var/www/.dbuser.txt'));
$dbpass = trim(file_get_contents('/var/www/.dbpass.txt'));


echo '<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashed Droplets | Information</title>
    <link rel="shortcut icon" type="image/svg+xml" href="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9Im5vIj8+CjxzdmcKICAgdmVyc2lvbj0iMS4wIgogICB3aWR0aD0iNjg1LjAwMDAwMHB0IgogICBoZWlnaHQ9IjY4NS4wMDAwMDBwdCIKICAgdmlld0JveD0iMCAwIDY4NS4wMDAwMDAgNjg1LjAwMDAwMCIKICAgcHJlc2VydmVBc3BlY3RSYXRpbz0ieE1pZFlNaWQgbWVldCIKICAgaWQ9InN2ZzI3IgogICB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciCiAgIHhtbG5zOnN2Zz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPgogIDxkZWZzCiAgICAgaWQ9ImRlZnMzMSIgLz4KICA8bWV0YWRhdGEKICAgICBpZD0ibWV0YWRhdGEyMSIgLz4KICA8ZwogICAgIGlkPSJsYXllcjEiCiAgICAgc3R5bGU9ImRpc3BsYXk6aW5saW5lO29wYWNpdHk6MSI+CiAgICA8ZWxsaXBzZQogICAgICAgc3R5bGU9ImZpbGw6IzM2MzkzZjtmaWxsLW9wYWNpdHk6MTtzdHJva2U6I2Q2OGQyMDtzdHJva2Utd2lkdGg6MTYuMDAyO3N0cm9rZS1taXRlcmxpbWl0OjQ7c3Ryb2tlLWRhc2hhcnJheTpub25lIgogICAgICAgaWQ9InBhdGg4NDgiCiAgICAgICBjeD0iMzQyLjU0OTEzIgogICAgICAgY3k9IjM0Mi42NTMxNyIKICAgICAgIHJ4PSIzMzQuNTczOTEiCiAgICAgICByeT0iMzM0LjY4OTYxIiAvPgogICAgPGNpcmNsZQogICAgICAgc3R5bGU9ImZpbGw6IzM2MzkzZjtmaWxsLW9wYWNpdHk6MTtzdHJva2U6I2Q2OGQyMDtzdHJva2Utd2lkdGg6MTQuNjgyO3N0cm9rZS1taXRlcmxpbWl0OjQ7c3Ryb2tlLWRhc2hhcnJheTpub25lO3N0cm9rZS1vcGFjaXR5OjEiCiAgICAgICBpZD0iYmFja2dyb3VuZCIKICAgICAgIGN4PSIzNDIuNjA5NDQiCiAgICAgICBjeT0iMzQyLjUxNDgzIgogICAgICAgcj0iMCIgLz4KICAgIDxjaXJjbGUKICAgICAgIHN0eWxlPSJmaWxsOiNkNjhkMjA7ZmlsbC1vcGFjaXR5OjE7c3Ryb2tlOiNkNjhkMjA7c3Ryb2tlLXdpZHRoOjkuNTk3MDc7c3Ryb2tlLW1pdGVybGltaXQ6NDtzdHJva2UtZGFzaGFycmF5Om5vbmU7c3Ryb2tlLW9wYWNpdHk6MSIKICAgICAgIGlkPSJwYXRoNDAwMSIKICAgICAgIGN4PSIyMTMuNTI3MzQiCiAgICAgICBjeT0iMjI3LjQ0MTQxIgogICAgICAgcj0iMzMuMjA1MzYiIC8+CiAgICA8Y2lyY2xlCiAgICAgICBzdHlsZT0iZmlsbDojZDY4ZDIwO2ZpbGwtb3BhY2l0eToxO3N0cm9rZTojZDY4ZDIwO3N0cm9rZS13aWR0aDo3Ljc0NTQyO3N0cm9rZS1taXRlcmxpbWl0OjQ7c3Ryb2tlLWRhc2hhcnJheTpub25lO3N0cm9rZS1vcGFjaXR5OjEiCiAgICAgICBpZD0icGF0aDQwMDMiCiAgICAgICBjeD0iNDQ2LjMyMDMxIgogICAgICAgY3k9IjIyNy45NzY1NiIKICAgICAgIHI9IjM0LjY2NjM1OSIgLz4KICAgIDxyZWN0CiAgICAgICBzdHlsZT0iZmlsbDojZDY4ZDIwO2ZpbGwtb3BhY2l0eToxO3N0cm9rZTojZDY4ZDIwO3N0cm9rZS13aWR0aDo0LjIzMTtzdHJva2UtbWl0ZXJsaW1pdDo0O3N0cm9rZS1kYXNoYXJyYXk6bm9uZTtzdHJva2Utb3BhY2l0eToxIgogICAgICAgaWQ9InJlY3Q0MDI3IgogICAgICAgd2lkdGg9IjQwMC4wMzU5MiIKICAgICAgIGhlaWdodD0iMTYuODY0MDM3IgogICAgICAgeD0iMTM0LjQ1NDciCiAgICAgICB5PSI0NTMuNDA3ODQiIC8+CiAgPC9nPgo8L3N2Zz4K" id="favicon" />
    <style type="text/css">
    @font-face {
      font-family: KaTeX_AMS;
      src: url(/static/fonts/KaTeX_AMS-Regular.e78e28b.woff2) format("woff2"),
          url(/static/fonts/KaTeX_AMS-Regular.7f06b4e.woff) format("woff"),
          url(/static/fonts/KaTeX_AMS-Regular.aaf4eee.ttf) format("truetype");
      font-weight: 400;
      font-style: normal;
  }

  @font-face {
      font-family: KaTeX_Caligraphic;
      src: url(/static/fonts/KaTeX_Caligraphic-Bold.4ec58be.woff2) format("woff2"),
          url(/static/fonts/KaTeX_Caligraphic-Bold.1e802ca.woff) format("woff"),
          url(/static/fonts/KaTeX_Caligraphic-Bold.021dd4d.ttf) format("truetype");
      font-weight: 700;
      font-style: normal;
  }

  @font-face {
      font-family: KaTeX_Caligraphic;
      src: url(/static/fonts/KaTeX_Caligraphic-Regular.7edb53b.woff2) format("woff2"),
          url(/static/fonts/KaTeX_Caligraphic-Regular.d3b46c3.woff) format("woff"),
          url(/static/fonts/KaTeX_Caligraphic-Regular.d49f2d5.ttf) format("truetype");
      font-weight: 400;
      font-style: normal;
  }

  @font-face {
      font-family: KaTeX_Fraktur;
      src: url(/static/fonts/KaTeX_Fraktur-Bold.d5b59ec.woff2) format("woff2"),
          url(/static/fonts/KaTeX_Fraktur-Bold.c4c8cab.woff) format("woff"),
          url(/static/fonts/KaTeX_Fraktur-Bold.a31e7cb.ttf) format("truetype");
      font-weight: 700;
      font-style: normal;
  }

  @font-face {
      font-family: KaTeX_Fraktur;
      src: url(/static/fonts/KaTeX_Fraktur-Regular.32a5339.woff2) format("woff2"),
          url(/static/fonts/KaTeX_Fraktur-Regular.b7d9c46.woff) format("woff"),
          url(/static/fonts/KaTeX_Fraktur-Regular.a48dad4.ttf) format("truetype");
      font-weight: 400;
      font-style: normal;
  }

  @font-face {
      font-family: KaTeX_Main;
      src: url(/static/fonts/KaTeX_Main-Bold.8e1e01c.woff2) format("woff2"),
          url(/static/fonts/KaTeX_Main-Bold.22086eb.woff) format("woff"),
          url(/static/fonts/KaTeX_Main-Bold.9ceff51.ttf) format("truetype");
      font-weight: 700;
      font-style: normal;
  }

  @font-face {
      font-family: KaTeX_Main;
      src: url(/static/fonts/KaTeX_Main-BoldItalic.284a17f.woff2) format("woff2"),
          url(/static/fonts/KaTeX_Main-BoldItalic.4c57dbc.woff) format("woff"),
          url(/static/fonts/KaTeX_Main-BoldItalic.e8b44b9.ttf) format("truetype");
      font-weight: 700;
      font-style: italic;
  }

  @font-face {
      font-family: KaTeX_Main;
      src: url(/static/fonts/KaTeX_Main-Italic.e533d5a.woff2) format("woff2"),
          url(/static/fonts/KaTeX_Main-Italic.99be0e1.woff) format("woff"),
          url(/static/fonts/KaTeX_Main-Italic.29c8639.ttf) format("truetype");
      font-weight: 400;
      font-style: italic;
  }

  @font-face {
      font-family: KaTeX_Main;
      src: url(/static/fonts/KaTeX_Main-Regular.5c734d7.woff2) format("woff2"),
          url(/static/fonts/KaTeX_Main-Regular.b741441.woff) format("woff"),
          url(/static/fonts/KaTeX_Main-Regular.5c94aef.ttf) format("truetype");
      font-weight: 400;
      font-style: normal;
  }

  @font-face {
      font-family: KaTeX_Math;
      src: url(/static/fonts/KaTeX_Math-BoldItalic.d747bd1.woff2) format("woff2"),
          url(/static/fonts/KaTeX_Math-BoldItalic.b13731e.woff) format("woff"),
          url(/static/fonts/KaTeX_Math-BoldItalic.9a2834a.ttf) format("truetype");
      font-weight: 700;
      font-style: italic;
  }

  @font-face {
      font-family: KaTeX_Math;
      src: url(/static/fonts/KaTeX_Math-Italic.4ad08b8.woff2) format("woff2"),
          url(/static/fonts/KaTeX_Math-Italic.f030390.woff) format("woff"),
          url(/static/fonts/KaTeX_Math-Italic.291e76b.ttf) format("truetype");
      font-weight: 400;
      font-style: italic;
  }

  @font-face {
      font-family: KaTeX_SansSerif;
      src: url(/static/fonts/KaTeX_SansSerif-Bold.6e0830b.woff2) format("woff2"),
          url(/static/fonts/KaTeX_SansSerif-Bold.3fb4195.woff) format("woff"),
          url(/static/fonts/KaTeX_SansSerif-Bold.7dc027c.ttf) format("truetype");
      font-weight: 700;
      font-style: normal;
  }

  @font-face {
      font-family: KaTeX_SansSerif;
      src: url(/static/fonts/KaTeX_SansSerif-Italic.fba01c9.woff2) format("woff2"),
          url(/static/fonts/KaTeX_SansSerif-Italic.727a9b0.woff) format("woff"),
          url(/static/fonts/KaTeX_SansSerif-Italic.4059868.ttf) format("truetype");
      font-weight: 400;
      font-style: italic;
  }

  @font-face {
      font-family: KaTeX_SansSerif;
      src: url(/static/fonts/KaTeX_SansSerif-Regular.d929cd6.woff2) format("woff2"),
          url(/static/fonts/KaTeX_SansSerif-Regular.2555754.woff) format("woff"),
          url(/static/fonts/KaTeX_SansSerif-Regular.5c58d16.ttf) format("truetype");
      font-weight: 400;
      font-style: normal;
  }

  @font-face {
      font-family: KaTeX_Script;
      src: url(/static/fonts/KaTeX_Script-Regular.755e249.woff2) format("woff2"),
          url(/static/fonts/KaTeX_Script-Regular.d524c9a.woff) format("woff"),
          url(/static/fonts/KaTeX_Script-Regular.d12ea9e.ttf) format("truetype");
      font-weight: 400;
      font-style: normal;
  }

  @font-face {
      font-family: KaTeX_Size1;
      src: url(/static/fonts/KaTeX_Size1-Regular.048c39c.woff2) format("woff2"),
          url(/static/fonts/KaTeX_Size1-Regular.08b5f00.woff) format("woff"),
          url(/static/fonts/KaTeX_Size1-Regular.7342d45.ttf) format("truetype");
      font-weight: 400;
      font-style: normal;
  }

  @font-face {
      font-family: KaTeX_Size2;
      src: url(/static/fonts/KaTeX_Size2-Regular.81d6b8d.woff2) format("woff2"),
          url(/static/fonts/KaTeX_Size2-Regular.af24b0e.woff) format("woff"),
          url(/static/fonts/KaTeX_Size2-Regular.eb130dc.ttf) format("truetype");
      font-weight: 400;
      font-style: normal;
  }

  @font-face {
      font-family: KaTeX_Size3;
      src: url(/static/fonts/KaTeX_Size3-Regular.b311ca0.woff2) format("woff2"),
          url(/static/fonts/KaTeX_Size3-Regular.0d89264.woff) format("woff"),
          url(/static/fonts/KaTeX_Size3-Regular.7e02a40.ttf) format("truetype");
      font-weight: 400;
      font-style: normal;
  }

  @font-face {
      font-family: KaTeX_Size4;
      src: url(/static/fonts/KaTeX_Size4-Regular.6a3255d.woff2) format("woff2"),
          url(/static/fonts/KaTeX_Size4-Regular.68895bb.woff) format("woff"),
          url(/static/fonts/KaTeX_Size4-Regular.ad76725.ttf) format("truetype");
      font-weight: 400;
      font-style: normal;
  }

  @font-face {
      font-family: KaTeX_Typewriter;
      src: url(/static/fonts/KaTeX_Typewriter-Regular.6cc31ea.woff2) format("woff2"),
          url(/static/fonts/KaTeX_Typewriter-Regular.3fe216d.woff) format("woff"),
          url(/static/fonts/KaTeX_Typewriter-Regular.2570235.ttf) format("truetype");
      font-weight: 400;
      font-style: normal;
  }

  .katex {
      font: normal 1.21em KaTeX_Main, Times New Roman, serif;
      line-height: 1.2;
      text-indent: 0;
      text-rendering: auto;
  }

  .katex * {
      -ms-high-contrast-adjust: none !important;
  }

  .katex .katex-version:after {
      content: "0.10.2";
  }

  .katex .katex-mathml {
      position: absolute;
      clip: rect(1px, 1px, 1px, 1px);
      padding: 0;
      border: 0;
      height: 1px;
      width: 1px;
      overflow: hidden;
  }

  .katex .katex-html>.newline {
      display: block;
  }

  .katex .base {
      position: relative;
      white-space: nowrap;
      width: min-content;
  }

  .katex .base,
  .katex .strut {
      display: inline-block;
  }

  .katex .textbf {
      font-weight: 700;
  }

  .katex .textit {
      font-style: italic;
  }

  .katex .textrm {
      font-family: KaTeX_Main;
  }

  .katex .textsf {
      font-family: KaTeX_SansSerif;
  }

  .katex .texttt {
      font-family: KaTeX_Typewriter;
  }

  .katex .mathdefault {
      font-family: KaTeX_Math;
      font-style: italic;
  }

  .katex .mathit {
      font-family: KaTeX_Main;
      font-style: italic;
  }

  .katex .mathrm {
      font-style: normal;
  }

  .katex .mathbf {
      font-family: KaTeX_Main;
      font-weight: 700;
  }

  .katex .boldsymbol {
      font-family: KaTeX_Math;
      font-weight: 700;
      font-style: italic;
  }

  .katex .amsrm,
  .katex .mathbb,
  .katex .textbb {
      font-family: KaTeX_AMS;
  }

  .katex .mathcal {
      font-family: KaTeX_Caligraphic;
  }

  .katex .mathfrak,
  .katex .textfrak {
      font-family: KaTeX_Fraktur;
  }

  .katex .mathtt {
      font-family: KaTeX_Typewriter;
  }

  .katex .mathscr,
  .katex .textscr {
      font-family: KaTeX_Script;
  }

  .katex .mathsf,
  .katex .textsf {
      font-family: KaTeX_SansSerif;
  }

  .katex .mathboldsf,
  .katex .textboldsf {
      font-family: KaTeX_SansSerif;
      font-weight: 700;
  }

  .katex .mathitsf,
  .katex .textitsf {
      font-family: KaTeX_SansSerif;
      font-style: italic;
  }

  .katex .mainrm {
      font-family: KaTeX_Main;
      font-style: normal;
  }

  .katex .vlist-t {
      display: inline-table;
      table-layout: fixed;
  }

  .katex .vlist-r {
      display: table-row;
  }

  .katex .vlist {
      display: table-cell;
      vertical-align: bottom;
      position: relative;
  }

  .katex .vlist>span {
      display: block;
      height: 0;
      position: relative;
  }

  .katex .vlist>span>span {
      display: inline-block;
  }

  .katex .vlist>span>.pstrut {
      overflow: hidden;
      width: 0;
  }

  .katex .vlist-t2 {
      margin-right: -2px;
  }

  .katex .vlist-s {
      display: table-cell;
      vertical-align: bottom;
      font-size: 1px;
      width: 2px;
      min-width: 2px;
  }

  .katex .msupsub {
      text-align: left;
  }

  .katex .mfrac>span>span {
      text-align: center;
  }

  .katex .mfrac .frac-line {
      display: inline-block;
      width: 100%;
      border-bottom-style: solid;
  }

  .katex .hdashline,
  .katex .hline,
  .katex .mfrac .frac-line,
  .katex .overline .overline-line,
  .katex .rule,
  .katex .underline .underline-line {
      min-height: 1px;
  }

  .katex .mspace {
      display: inline-block;
  }

  .katex .clap,
  .katex .llap,
  .katex .rlap {
      width: 0;
      position: relative;
  }

  .katex .clap>.inner,
  .katex .llap>.inner,
  .katex .rlap>.inner {
      position: absolute;
  }

  .katex .clap>.fix,
  .katex .llap>.fix,
  .katex .rlap>.fix {
      display: inline-block;
  }

  .katex .llap>.inner {
      right: 0;
  }

  .katex .clap>.inner,
  .katex .rlap>.inner {
      left: 0;
  }

  .katex .clap>.inner>span {
      margin-left: -50%;
      margin-right: 50%;
  }

  .katex .rule {
      display: inline-block;
      border: 0 solid;
      position: relative;
  }

  .katex .hline,
  .katex .overline .overline-line,
  .katex .underline .underline-line {
      display: inline-block;
      width: 100%;
      border-bottom-style: solid;
  }

  .katex .hdashline {
      display: inline-block;
      width: 100%;
      border-bottom-style: dashed;
  }

  .katex .sqrt>.root {
      margin-left: 0.27777778em;
      margin-right: -0.55555556em;
  }

  .katex .fontsize-ensurer,
  .katex .sizing {
      display: inline-block;
  }

  .katex .fontsize-ensurer.reset-size1.size1,
  .katex .sizing.reset-size1.size1 {
      font-size: 1em;
  }

  .katex .fontsize-ensurer.reset-size1.size2,
  .katex .sizing.reset-size1.size2 {
      font-size: 1.2em;
  }

  .katex .fontsize-ensurer.reset-size1.size3,
  .katex .sizing.reset-size1.size3 {
      font-size: 1.4em;
  }

  .katex .fontsize-ensurer.reset-size1.size4,
  .katex .sizing.reset-size1.size4 {
      font-size: 1.6em;
  }

  .katex .fontsize-ensurer.reset-size1.size5,
  .katex .sizing.reset-size1.size5 {
      font-size: 1.8em;
  }

  .katex .fontsize-ensurer.reset-size1.size6,
  .katex .sizing.reset-size1.size6 {
      font-size: 2em;
  }

  .katex .fontsize-ensurer.reset-size1.size7,
  .katex .sizing.reset-size1.size7 {
      font-size: 2.4em;
  }

  .katex .fontsize-ensurer.reset-size1.size8,
  .katex .sizing.reset-size1.size8 {
      font-size: 2.88em;
  }

  .katex .fontsize-ensurer.reset-size1.size9,
  .katex .sizing.reset-size1.size9 {
      font-size: 3.456em;
  }

  .katex .fontsize-ensurer.reset-size1.size10,
  .katex .sizing.reset-size1.size10 {
      font-size: 4.148em;
  }

  .katex .fontsize-ensurer.reset-size1.size11,
  .katex .sizing.reset-size1.size11 {
      font-size: 4.976em;
  }

  .katex .fontsize-ensurer.reset-size2.size1,
  .katex .sizing.reset-size2.size1 {
      font-size: 0.83333333em;
  }

  .katex .fontsize-ensurer.reset-size2.size2,
  .katex .sizing.reset-size2.size2 {
      font-size: 1em;
  }

  .katex .fontsize-ensurer.reset-size2.size3,
  .katex .sizing.reset-size2.size3 {
      font-size: 1.16666667em;
  }

  .katex .fontsize-ensurer.reset-size2.size4,
  .katex .sizing.reset-size2.size4 {
      font-size: 1.33333333em;
  }

  .katex .fontsize-ensurer.reset-size2.size5,
  .katex .sizing.reset-size2.size5 {
      font-size: 1.5em;
  }

  .katex .fontsize-ensurer.reset-size2.size6,
  .katex .sizing.reset-size2.size6 {
      font-size: 1.66666667em;
  }

  .katex .fontsize-ensurer.reset-size2.size7,
  .katex .sizing.reset-size2.size7 {
      font-size: 2em;
  }

  .katex .fontsize-ensurer.reset-size2.size8,
  .katex .sizing.reset-size2.size8 {
      font-size: 2.4em;
  }

  .katex .fontsize-ensurer.reset-size2.size9,
  .katex .sizing.reset-size2.size9 {
      font-size: 2.88em;
  }

  .katex .fontsize-ensurer.reset-size2.size10,
  .katex .sizing.reset-size2.size10 {
      font-size: 3.45666667em;
  }

  .katex .fontsize-ensurer.reset-size2.size11,
  .katex .sizing.reset-size2.size11 {
      font-size: 4.14666667em;
  }

  .katex .fontsize-ensurer.reset-size3.size1,
  .katex .sizing.reset-size3.size1 {
      font-size: 0.71428571em;
  }

  .katex .fontsize-ensurer.reset-size3.size2,
  .katex .sizing.reset-size3.size2 {
      font-size: 0.85714286em;
  }

  .katex .fontsize-ensurer.reset-size3.size3,
  .katex .sizing.reset-size3.size3 {
      font-size: 1em;
  }

  .katex .fontsize-ensurer.reset-size3.size4,
  .katex .sizing.reset-size3.size4 {
      font-size: 1.14285714em;
  }

  .katex .fontsize-ensurer.reset-size3.size5,
  .katex .sizing.reset-size3.size5 {
      font-size: 1.28571429em;
  }

  .katex .fontsize-ensurer.reset-size3.size6,
  .katex .sizing.reset-size3.size6 {
      font-size: 1.42857143em;
  }

  .katex .fontsize-ensurer.reset-size3.size7,
  .katex .sizing.reset-size3.size7 {
      font-size: 1.71428571em;
  }

  .katex .fontsize-ensurer.reset-size3.size8,
  .katex .sizing.reset-size3.size8 {
      font-size: 2.05714286em;
  }

  .katex .fontsize-ensurer.reset-size3.size9,
  .katex .sizing.reset-size3.size9 {
      font-size: 2.46857143em;
  }

  .katex .fontsize-ensurer.reset-size3.size10,
  .katex .sizing.reset-size3.size10 {
      font-size: 2.96285714em;
  }

  .katex .fontsize-ensurer.reset-size3.size11,
  .katex .sizing.reset-size3.size11 {
      font-size: 3.55428571em;
  }

  .katex .fontsize-ensurer.reset-size4.size1,
  .katex .sizing.reset-size4.size1 {
      font-size: 0.625em;
  }

  .katex .fontsize-ensurer.reset-size4.size2,
  .katex .sizing.reset-size4.size2 {
      font-size: 0.75em;
  }

  .katex .fontsize-ensurer.reset-size4.size3,
  .katex .sizing.reset-size4.size3 {
      font-size: 0.875em;
  }

  .katex .fontsize-ensurer.reset-size4.size4,
  .katex .sizing.reset-size4.size4 {
      font-size: 1em;
  }

  .katex .fontsize-ensurer.reset-size4.size5,
  .katex .sizing.reset-size4.size5 {
      font-size: 1.125em;
  }

  .katex .fontsize-ensurer.reset-size4.size6,
  .katex .sizing.reset-size4.size6 {
      font-size: 1.25em;
  }

  .katex .fontsize-ensurer.reset-size4.size7,
  .katex .sizing.reset-size4.size7 {
      font-size: 1.5em;
  }

  .katex .fontsize-ensurer.reset-size4.size8,
  .katex .sizing.reset-size4.size8 {
      font-size: 1.8em;
  }

  .katex .fontsize-ensurer.reset-size4.size9,
  .katex .sizing.reset-size4.size9 {
      font-size: 2.16em;
  }

  .katex .fontsize-ensurer.reset-size4.size10,
  .katex .sizing.reset-size4.size10 {
      font-size: 2.5925em;
  }

  .katex .fontsize-ensurer.reset-size4.size11,
  .katex .sizing.reset-size4.size11 {
      font-size: 3.11em;
  }

  .katex .fontsize-ensurer.reset-size5.size1,
  .katex .sizing.reset-size5.size1 {
      font-size: 0.55555556em;
  }

  .katex .fontsize-ensurer.reset-size5.size2,
  .katex .sizing.reset-size5.size2 {
      font-size: 0.66666667em;
  }

  .katex .fontsize-ensurer.reset-size5.size3,
  .katex .sizing.reset-size5.size3 {
      font-size: 0.77777778em;
  }

  .katex .fontsize-ensurer.reset-size5.size4,
  .katex .sizing.reset-size5.size4 {
      font-size: 0.88888889em;
  }

  .katex .fontsize-ensurer.reset-size5.size5,
  .katex .sizing.reset-size5.size5 {
      font-size: 1em;
  }

  .katex .fontsize-ensurer.reset-size5.size6,
  .katex .sizing.reset-size5.size6 {
      font-size: 1.11111111em;
  }

  .katex .fontsize-ensurer.reset-size5.size7,
  .katex .sizing.reset-size5.size7 {
      font-size: 1.33333333em;
  }

  .katex .fontsize-ensurer.reset-size5.size8,
  .katex .sizing.reset-size5.size8 {
      font-size: 1.6em;
  }

  .katex .fontsize-ensurer.reset-size5.size9,
  .katex .sizing.reset-size5.size9 {
      font-size: 1.92em;
  }

  .katex .fontsize-ensurer.reset-size5.size10,
  .katex .sizing.reset-size5.size10 {
      font-size: 2.30444444em;
  }

  .katex .fontsize-ensurer.reset-size5.size11,
  .katex .sizing.reset-size5.size11 {
      font-size: 2.76444444em;
  }

  .katex .fontsize-ensurer.reset-size6.size1,
  .katex .sizing.reset-size6.size1 {
      font-size: 0.5em;
  }

  .katex .fontsize-ensurer.reset-size6.size2,
  .katex .sizing.reset-size6.size2 {
      font-size: 0.6em;
  }

  .katex .fontsize-ensurer.reset-size6.size3,
  .katex .sizing.reset-size6.size3 {
      font-size: 0.7em;
  }

  .katex .fontsize-ensurer.reset-size6.size4,
  .katex .sizing.reset-size6.size4 {
      font-size: 0.8em;
  }

  .katex .fontsize-ensurer.reset-size6.size5,
  .katex .sizing.reset-size6.size5 {
      font-size: 0.9em;
  }

  .katex .fontsize-ensurer.reset-size6.size6,
  .katex .sizing.reset-size6.size6 {
      font-size: 1em;
  }

  .katex .fontsize-ensurer.reset-size6.size7,
  .katex .sizing.reset-size6.size7 {
      font-size: 1.2em;
  }

  .katex .fontsize-ensurer.reset-size6.size8,
  .katex .sizing.reset-size6.size8 {
      font-size: 1.44em;
  }

  .katex .fontsize-ensurer.reset-size6.size9,
  .katex .sizing.reset-size6.size9 {
      font-size: 1.728em;
  }

  .katex .fontsize-ensurer.reset-size6.size10,
  .katex .sizing.reset-size6.size10 {
      font-size: 2.074em;
  }

  .katex .fontsize-ensurer.reset-size6.size11,
  .katex .sizing.reset-size6.size11 {
      font-size: 2.488em;
  }

  .katex .fontsize-ensurer.reset-size7.size1,
  .katex .sizing.reset-size7.size1 {
      font-size: 0.41666667em;
  }

  .katex .fontsize-ensurer.reset-size7.size2,
  .katex .sizing.reset-size7.size2 {
      font-size: 0.5em;
  }

  .katex .fontsize-ensurer.reset-size7.size3,
  .katex .sizing.reset-size7.size3 {
      font-size: 0.58333333em;
  }

  .katex .fontsize-ensurer.reset-size7.size4,
  .katex .sizing.reset-size7.size4 {
      font-size: 0.66666667em;
  }

  .katex .fontsize-ensurer.reset-size7.size5,
  .katex .sizing.reset-size7.size5 {
      font-size: 0.75em;
  }

  .katex .fontsize-ensurer.reset-size7.size6,
  .katex .sizing.reset-size7.size6 {
      font-size: 0.83333333em;
  }

  .katex .fontsize-ensurer.reset-size7.size7,
  .katex .sizing.reset-size7.size7 {
      font-size: 1em;
  }

  .katex .fontsize-ensurer.reset-size7.size8,
  .katex .sizing.reset-size7.size8 {
      font-size: 1.2em;
  }

  .katex .fontsize-ensurer.reset-size7.size9,
  .katex .sizing.reset-size7.size9 {
      font-size: 1.44em;
  }

  .katex .fontsize-ensurer.reset-size7.size10,
  .katex .sizing.reset-size7.size10 {
      font-size: 1.72833333em;
  }

  .katex .fontsize-ensurer.reset-size7.size11,
  .katex .sizing.reset-size7.size11 {
      font-size: 2.07333333em;
  }

  .katex .fontsize-ensurer.reset-size8.size1,
  .katex .sizing.reset-size8.size1 {
      font-size: 0.34722222em;
  }

  .katex .fontsize-ensurer.reset-size8.size2,
  .katex .sizing.reset-size8.size2 {
      font-size: 0.41666667em;
  }

  .katex .fontsize-ensurer.reset-size8.size3,
  .katex .sizing.reset-size8.size3 {
      font-size: 0.48611111em;
  }

  .katex .fontsize-ensurer.reset-size8.size4,
  .katex .sizing.reset-size8.size4 {
      font-size: 0.55555556em;
  }

  .katex .fontsize-ensurer.reset-size8.size5,
  .katex .sizing.reset-size8.size5 {
      font-size: 0.625em;
  }

  .katex .fontsize-ensurer.reset-size8.size6,
  .katex .sizing.reset-size8.size6 {
      font-size: 0.69444444em;
  }

  .katex .fontsize-ensurer.reset-size8.size7,
  .katex .sizing.reset-size8.size7 {
      font-size: 0.83333333em;
  }

  .katex .fontsize-ensurer.reset-size8.size8,
  .katex .sizing.reset-size8.size8 {
      font-size: 1em;
  }

  .katex .fontsize-ensurer.reset-size8.size9,
  .katex .sizing.reset-size8.size9 {
      font-size: 1.2em;
  }

  .katex .fontsize-ensurer.reset-size8.size10,
  .katex .sizing.reset-size8.size10 {
      font-size: 1.44027778em;
  }

  .katex .fontsize-ensurer.reset-size8.size11,
  .katex .sizing.reset-size8.size11 {
      font-size: 1.72777778em;
  }

  .katex .fontsize-ensurer.reset-size9.size1,
  .katex .sizing.reset-size9.size1 {
      font-size: 0.28935185em;
  }

  .katex .fontsize-ensurer.reset-size9.size2,
  .katex .sizing.reset-size9.size2 {
      font-size: 0.34722222em;
  }

  .katex .fontsize-ensurer.reset-size9.size3,
  .katex .sizing.reset-size9.size3 {
      font-size: 0.40509259em;
  }

  .katex .fontsize-ensurer.reset-size9.size4,
  .katex .sizing.reset-size9.size4 {
      font-size: 0.46296296em;
  }

  .katex .fontsize-ensurer.reset-size9.size5,
  .katex .sizing.reset-size9.size5 {
      font-size: 0.52083333em;
  }

  .katex .fontsize-ensurer.reset-size9.size6,
  .katex .sizing.reset-size9.size6 {
      font-size: 0.5787037em;
  }

  .katex .fontsize-ensurer.reset-size9.size7,
  .katex .sizing.reset-size9.size7 {
      font-size: 0.69444444em;
  }

  .katex .fontsize-ensurer.reset-size9.size8,
  .katex .sizing.reset-size9.size8 {
      font-size: 0.83333333em;
  }

  .katex .fontsize-ensurer.reset-size9.size9,
  .katex .sizing.reset-size9.size9 {
      font-size: 1em;
  }

  .katex .fontsize-ensurer.reset-size9.size10,
  .katex .sizing.reset-size9.size10 {
      font-size: 1.20023148em;
  }

  .katex .fontsize-ensurer.reset-size9.size11,
  .katex .sizing.reset-size9.size11 {
      font-size: 1.43981481em;
  }

  .katex .fontsize-ensurer.reset-size10.size1,
  .katex .sizing.reset-size10.size1 {
      font-size: 0.24108004em;
  }

  .katex .fontsize-ensurer.reset-size10.size2,
  .katex .sizing.reset-size10.size2 {
      font-size: 0.28929605em;
  }

  .katex .fontsize-ensurer.reset-size10.size3,
  .katex .sizing.reset-size10.size3 {
      font-size: 0.33751205em;
  }

  .katex .fontsize-ensurer.reset-size10.size4,
  .katex .sizing.reset-size10.size4 {
      font-size: 0.38572806em;
  }

  .katex .fontsize-ensurer.reset-size10.size5,
  .katex .sizing.reset-size10.size5 {
      font-size: 0.43394407em;
  }

  .katex .fontsize-ensurer.reset-size10.size6,
  .katex .sizing.reset-size10.size6 {
      font-size: 0.48216008em;
  }

  .katex .fontsize-ensurer.reset-size10.size7,
  .katex .sizing.reset-size10.size7 {
      font-size: 0.57859209em;
  }

  .katex .fontsize-ensurer.reset-size10.size8,
  .katex .sizing.reset-size10.size8 {
      font-size: 0.69431051em;
  }

  .katex .fontsize-ensurer.reset-size10.size9,
  .katex .sizing.reset-size10.size9 {
      font-size: 0.83317261em;
  }

  .katex .fontsize-ensurer.reset-size10.size10,
  .katex .sizing.reset-size10.size10 {
      font-size: 1em;
  }

  .katex .fontsize-ensurer.reset-size10.size11,
  .katex .sizing.reset-size10.size11 {
      font-size: 1.19961427em;
  }

  .katex .fontsize-ensurer.reset-size11.size1,
  .katex .sizing.reset-size11.size1 {
      font-size: 0.20096463em;
  }

  .katex .fontsize-ensurer.reset-size11.size2,
  .katex .sizing.reset-size11.size2 {
      font-size: 0.24115756em;
  }

  .katex .fontsize-ensurer.reset-size11.size3,
  .katex .sizing.reset-size11.size3 {
      font-size: 0.28135048em;
  }

  .katex .fontsize-ensurer.reset-size11.size4,
  .katex .sizing.reset-size11.size4 {
      font-size: 0.32154341em;
  }

  .katex .fontsize-ensurer.reset-size11.size5,
  .katex .sizing.reset-size11.size5 {
      font-size: 0.36173633em;
  }

  .katex .fontsize-ensurer.reset-size11.size6,
  .katex .sizing.reset-size11.size6 {
      font-size: 0.40192926em;
  }

  .katex .fontsize-ensurer.reset-size11.size7,
  .katex .sizing.reset-size11.size7 {
      font-size: 0.48231511em;
  }

  .katex .fontsize-ensurer.reset-size11.size8,
  .katex .sizing.reset-size11.size8 {
      font-size: 0.57877814em;
  }

  .katex .fontsize-ensurer.reset-size11.size9,
  .katex .sizing.reset-size11.size9 {
      font-size: 0.69453376em;
  }

  .katex .fontsize-ensurer.reset-size11.size10,
  .katex .sizing.reset-size11.size10 {
      font-size: 0.83360129em;
  }

  .katex .fontsize-ensurer.reset-size11.size11,
  .katex .sizing.reset-size11.size11 {
      font-size: 1em;
  }

  .katex .delimsizing.size1 {
      font-family: KaTeX_Size1;
  }

  .katex .delimsizing.size2 {
      font-family: KaTeX_Size2;
  }

  .katex .delimsizing.size3 {
      font-family: KaTeX_Size3;
  }

  .katex .delimsizing.size4 {
      font-family: KaTeX_Size4;
  }

  .katex .delimsizing.mult .delim-size1>span {
      font-family: KaTeX_Size1;
  }

  .katex .delimsizing.mult .delim-size4>span {
      font-family: KaTeX_Size4;
  }

  .katex .nulldelimiter {
      display: inline-block;
      width: 0.12em;
  }

  .katex .delimcenter,
  .katex .op-symbol {
      position: relative;
  }

  .katex .op-symbol.small-op {
      font-family: KaTeX_Size1;
  }

  .katex .op-symbol.large-op {
      font-family: KaTeX_Size2;
  }

  .katex .accent>.vlist-t,
  .katex .op-limits>.vlist-t {
      text-align: center;
  }

  .katex .accent .accent-body {
      position: relative;
  }

  .katex .accent .accent-body:not(.accent-full) {
      width: 0;
  }

  .katex .overlay {
      display: block;
  }

  .katex .mtable .vertical-separator {
      display: inline-block;
      margin: 0 -0.025em;
      border-right: 0.05em solid;
      min-width: 1px;
  }

  .katex .mtable .vs-dashed {
      border-right: 0.05em dashed;
  }

  .katex .mtable .arraycolsep {
      display: inline-block;
  }

  .katex .mtable .col-align-c>.vlist-t {
      text-align: center;
  }

  .katex .mtable .col-align-l>.vlist-t {
      text-align: left;
  }

  .katex .mtable .col-align-r>.vlist-t {
      text-align: right;
  }

  .katex .svg-align {
      text-align: left;
  }

  .katex svg {
      display: block;
      position: absolute;
      width: 100%;
      height: inherit;
      fill: currentColor;
      stroke: currentColor;
      fill-rule: nonzero;
      fill-opacity: 1;
      stroke-width: 1;
      stroke-linecap: butt;
      stroke-linejoin: miter;
      stroke-miterlimit: 4;
      stroke-dasharray: none;
      stroke-dashoffset: 0;
      stroke-opacity: 1;
  }

  .katex svg path {
      stroke: none;
  }

  .katex img {
      border-style: none;
      min-width: 0;
      min-height: 0;
      max-width: none;
      max-height: none;
  }

  .katex .stretchy {
      width: 100%;
      display: block;
      position: relative;
      overflow: hidden;
  }

  .katex .stretchy:after,
  .katex .stretchy:before {
      content: "";
  }

  .katex .hide-tail {
      width: 100%;
      position: relative;
      overflow: hidden;
  }

  .katex .halfarrow-left {
      position: absolute;
      left: 0;
      width: 50.2%;
      overflow: hidden;
  }

  .katex .halfarrow-right {
      position: absolute;
      right: 0;
      width: 50.2%;
      overflow: hidden;
  }

  .katex .brace-left {
      position: absolute;
      left: 0;
      width: 25.1%;
      overflow: hidden;
  }

  .katex .brace-center {
      position: absolute;
      left: 25%;
      width: 50%;
      overflow: hidden;
  }

  .katex .brace-right {
      position: absolute;
      right: 0;
      width: 25.1%;
      overflow: hidden;
  }

  .katex .x-arrow-pad {
      padding: 0 0.5em;
  }

  .katex .mover,
  .katex .munder,
  .katex .x-arrow {
      text-align: center;
  }

  .katex .boxpad {
      padding: 0 0.3em;
  }

  .katex .fbox,
  .katex .fcolorbox {
      box-sizing: border-box;
      border: 0.04em solid;
  }

  .katex .cancel-pad {
      padding: 0 0.2em;
  }

  .katex .cancel-lap {
      margin-left: -0.2em;
      margin-right: -0.2em;
  }

  .katex .sout {
      border-bottom-style: solid;
      border-bottom-width: 0.08em;
  }

  .katex-display {
      display: block;
      margin: 1em 0;
      text-align: center;
  }

  .katex-display>.katex {
      display: block;
      text-align: center;
      white-space: nowrap;
  }

  .katex-display>.katex>.katex-html {
      display: block;
      position: relative;
  }

  .katex-display>.katex>.katex-html>.tag {
      position: absolute;
      right: 0;
  }

  .katex-display.leqno>.katex>.katex-html>.tag {
      left: 0;
      right: auto;
  }

  .katex-display.fleqn>.katex {
      text-align: left;
  }

  @font-face {
      font-family: Lato;
      font-style: normal;
      font-weight: 400;
      src: url(/static/fonts/lato-normal.27bd77b.woff) format("woff");
  }

  @font-face {
      font-family: Lato;
      font-style: italic;
      font-weight: 400;
      src: url(/static/fonts/lato-normal-italic.f28f2d6.woff) format("woff");
  }

  @font-face {
      font-family: Lato;
      font-style: normal;
      font-weight: 600;
      src: url(/static/fonts/lato-black.f80bda6.woff) format("woff");
  }

  @font-face {
      font-family: Lato;
      font-style: italic;
      font-weight: 600;
      src: url(/static/fonts/lato-black-italic.798eafd.woff) format("woff");
  }

  @font-face {
      font-family: Roboto Mono;
      font-style: normal;
      font-weight: 400;
      src: url(/static/fonts/RobotoMono-Regular.0b6a547.woff) format("woff");
  }

  @font-face {
      font-family: Roboto Mono;
      font-style: normal;
      font-weight: 600;
      src: url(/static/fonts/RobotoMono-Bold.819f3b2.woff) format("woff");
  }

  .prism *,
  .token.pre.gfm * {
      font-weight: inherit !important;
  }

  .prism .token.cdata,
  .prism .token.comment,
  .prism .token.doctype,
  .prism .token.prolog,
  .token.pre.gfm .token.cdata,
  .token.pre.gfm .token.comment,
  .token.pre.gfm .token.doctype,
  .token.pre.gfm .token.prolog {
      color: #708090;
  }

  .prism .token.punctuation,
  .token.pre.gfm .token.punctuation {
      color: #999;
  }

  .prism .namespace,
  .token.pre.gfm .namespace {
      opacity: 0.7;
  }

  .prism .token.boolean,
  .prism .token.constant,
  .prism .token.deleted,
  .prism .token.number,
  .prism .token.property,
  .prism .token.symbol,
  .prism .token.tag,
  .token.pre.gfm .token.boolean,
  .token.pre.gfm .token.constant,
  .token.pre.gfm .token.deleted,
  .token.pre.gfm .token.number,
  .token.pre.gfm .token.property,
  .token.pre.gfm .token.symbol,
  .token.pre.gfm .token.tag {
      color: #905;
  }

  .prism .token.attr-name,
  .prism .token.builtin,
  .prism .token.char,
  .prism .token.inserted,
  .prism .token.selector,
  .prism .token.string,
  .token.pre.gfm .token.attr-name,
  .token.pre.gfm .token.builtin,
  .token.pre.gfm .token.char,
  .token.pre.gfm .token.inserted,
  .token.pre.gfm .token.selector,
  .token.pre.gfm .token.string {
      color: #690;
  }

  .prism .language-css .token.string,
  .prism .style .token.string,
  .prism .token.entity,
  .prism .token.operator,
  .prism .token.url,
  .token.pre.gfm .language-css .token.string,
  .token.pre.gfm .style .token.string,
  .token.pre.gfm .token.entity,
  .token.pre.gfm .token.operator,
  .token.pre.gfm .token.url {
      color: #a67f59;
  }

  .prism .token.atrule,
  .prism .token.attr-value,
  .prism .token.keyword,
  .token.pre.gfm .token.atrule,
  .token.pre.gfm .token.attr-value,
  .token.pre.gfm .token.keyword {
      color: #07a;
  }

  .prism .token.function,
  .token.pre.gfm .token.function {
      color: #dd4a68;
  }

  .prism .token.important,
  .prism .token.regex,
  .prism .token.variable,
  .token.pre.gfm .token.important,
  .token.pre.gfm .token.regex,
  .token.pre.gfm .token.variable {
      color: #e90;
  }

  .prism .token.bold,
  .prism .token.important,
  .token.pre.gfm .token.bold,
  .token.pre.gfm .token.important {
      font-weight: 500;
  }

  .prism .token.italic,
  .token.pre.gfm .token.italic {
      font-style: italic;
  }

  .mermaid {
      font-size: 16px;
  }

  .mermaid svg {
      color: rgba(0, 0, 0, 0.75);
      width: 100%;
      max-width: 100%;
  }

  .app--dark .mermaid svg {
      color: hsla(0, 0%, 100%, 0.75);
  }

  .mermaid svg * {
      font-family: Lato, Helvetica Neue, Helvetica, sans-serif;
  }

  .mermaid .mermaid .label {
      color: #333;
  }

  .mermaid .node circle,
  .mermaid .node ellipse,
  .mermaid .node polygon,
  .mermaid .node rect {
      fill: #eee;
      stroke: #999;
      stroke-width: 1px;
  }

  .mermaid .node.clickable {
      cursor: pointer;
  }

  .mermaid .arrowheadPath {
      fill: #333;
  }

  .mermaid .edgePath .path {
      stroke: #666;
      stroke-width: 1.5px;
  }

  .mermaid .edgeLabel {
      background-color: #fff;
  }

  .mermaid .cluster rect {
      fill: #eaf2fb !important;
      stroke: #26a !important;
      stroke-width: 1px !important;
  }

  .mermaid .cluster text {
      fill: #333;
  }

  .mermaid div.mermaidTooltip {
      position: absolute;
      text-align: center;
      max-width: 200px;
      padding: 2px;
      font-family: trebuchet ms, verdana, arial;
      font-size: 12px;
      background: #eaf2fb;
      border: 1px solid #26a;
      border-radius: 2px;
      pointer-events: none;
      z-index: 100;
  }

  .mermaid .actor {
      stroke: #999;
      fill: #eee;
  }

  .mermaid text.actor {
      fill: #333;
      stroke: none;
  }

  .mermaid .actor-line {
      stroke: #666;
  }

  .mermaid .messageLine0 {
      marker-end: "url(#arrowhead)";
  }

  .mermaid .messageLine0,
  .mermaid .messageLine1 {
      stroke-width: 1.5;
      stroke-dasharray: "2 2";
      stroke: #333;
  }

  .mermaid #arrowhead {
      fill: #333;
  }

  .mermaid #crosshead path {
      fill: #333 !important;
      stroke: #333 !important;
  }

  .mermaid .messageText {
      fill: #333;
      stroke: none;
  }

  .mermaid .labelBox {
      stroke: #999;
      fill: #eee;
  }

  .mermaid .labelText,
  .mermaid .loopText {
      fill: #fff;
      stroke: none;
  }

  .mermaid .loopLine {
      stroke-width: 2;
      stroke-dasharray: "2 2";
      marker-end: "url(#arrowhead)";
      stroke: #999;
  }

  .mermaid .note {
      stroke: #770;
      fill: #ffa;
  }

  .mermaid .noteText {
      fill: #000;
      stroke: none;
      font-family: trebuchet ms, verdana, arial;
      font-size: 14px;
  }

  .mermaid .section {
      stroke: none;
      opacity: 0.2;
  }

  .mermaid .section0,
  .mermaid .section2 {
      fill: #80b3e6;
  }

  .mermaid .section1,
  .mermaid .section3 {
      fill: #fff;
      opacity: 0.2;
  }

  .mermaid .sectionTitle0,
  .mermaid .sectionTitle1,
  .mermaid .sectionTitle2,
  .mermaid .sectionTitle3 {
      fill: #333;
  }

  .mermaid .sectionTitle {
      text-anchor: start;
      font-size: 11px;
  }

  .mermaid .grid .tick {
      stroke: #e6e6e6;
      opacity: 0.3;
      shape-rendering: crispEdges;
  }

  .mermaid .grid path {
      stroke-width: 0;
  }

  .mermaid .today {
      fill: none;
      stroke: #d42;
      stroke-width: 2px;
  }

  .mermaid .task {
      stroke-width: 2;
  }

  .mermaid .taskText {
      text-anchor: middle;
      font-size: 11px;
  }

  .mermaid .taskTextOutsideRight {
      fill: #333;
      text-anchor: start;
      font-size: 11px;
  }

  .mermaid .taskTextOutsideLeft {
      fill: #333;
      text-anchor: end;
      font-size: 11px;
  }

  .mermaid .taskText0,
  .mermaid .taskText1,
  .mermaid .taskText2,
  .mermaid .taskText3 {
      fill: #fff;
  }

  .mermaid .task0,
  .mermaid .task1,
  .mermaid .task2,
  .mermaid .task3 {
      fill: #26a;
      stroke: #1a4d80;
  }

  .mermaid .taskTextOutside0,
  .mermaid .taskTextOutside1,
  .mermaid .taskTextOutside2,
  .mermaid .taskTextOutside3 {
      fill: #333;
  }

  .mermaid .active0,
  .mermaid .active1,
  .mermaid .active2,
  .mermaid .active3 {
      fill: #eee;
      stroke: #1a4d80;
  }

  .mermaid .activeText0,
  .mermaid .activeText1,
  .mermaid .activeText2,
  .mermaid .activeText3 {
      fill: #333 !important;
  }

  .mermaid .done0,
  .mermaid .done1,
  .mermaid .done2,
  .mermaid .done3 {
      stroke: #666;
      fill: #bbb;
      stroke-width: 2;
  }

  .mermaid .doneText0,
  .mermaid .doneText1,
  .mermaid .doneText2,
  .mermaid .doneText3 {
      fill: #333 !important;
  }

  .mermaid .crit0,
  .mermaid .crit1,
  .mermaid .crit2,
  .mermaid .crit3 {
      stroke: #b1361b;
      fill: #d42;
      stroke-width: 2;
  }

  .mermaid .activeCrit0,
  .mermaid .activeCrit1,
  .mermaid .activeCrit2,
  .mermaid .activeCrit3 {
      stroke: #b1361b;
      fill: #eee;
      stroke-width: 2;
  }

  .mermaid .doneCrit0,
  .mermaid .doneCrit1,
  .mermaid .doneCrit2,
  .mermaid .doneCrit3 {
      stroke: #b1361b;
      fill: #bbb;
      stroke-width: 2;
      cursor: pointer;
      shape-rendering: crispEdges;
  }

  .mermaid .activeCritText0,
  .mermaid .activeCritText1,
  .mermaid .activeCritText2,
  .mermaid .activeCritText3,
  .mermaid .doneCritText0,
  .mermaid .doneCritText1,
  .mermaid .doneCritText2,
  .mermaid .doneCritText3 {
      fill: #333 !important;
  }

  .mermaid .titleText {
      text-anchor: middle;
      font-size: 18px;
      fill: #333;
  }

  .mermaid g.classGroup text {
      fill: #999;
      stroke: none;
      font-family: trebuchet ms, verdana, arial;
      font-size: 10px;
  }

  .mermaid g.classGroup rect {
      fill: #eee;
      stroke: #999;
  }

  .mermaid g.classGroup line {
      stroke: #999;
      stroke-width: 1;
  }

  .mermaid .classLabel .box {
      stroke: none;
      stroke-width: 0;
      fill: #eee;
      opacity: 0.5;
  }

  .mermaid .classLabel .label {
      fill: #999;
      font-size: 10px;
  }

  .mermaid .relation {
      stroke: #999;
      stroke-width: 1;
      fill: none;
  }

  .mermaid #compositionEnd,
  .mermaid #compositionStart {
      fill: #999;
      stroke: #999;
      stroke-width: 1;
  }

  .mermaid #aggregationEnd,
  .mermaid #aggregationStart {
      fill: #eee;
      stroke: #999;
      stroke-width: 1;
  }

  .mermaid #dependencyEnd,
  .mermaid #dependencyStart,
  .mermaid #extensionEnd,
  .mermaid #extensionStart {
      fill: #999;
      stroke: #999;
      stroke-width: 1;
  }

  .mermaid .branch-label,
  .mermaid .commit-id,
  .mermaid .commit-msg {
      fill: #d3d3d3;
      color: #d3d3d3;
  }

  .app--dark .mermaid .label {
      color: #323d47;
  }

  .app--dark .mermaid .node circle,
  .app--dark .mermaid .node ellipse,
  .app--dark .mermaid .node polygon,
  .app--dark .mermaid .node rect {
      fill: #bdd5ea;
      stroke: purple;
      stroke-width: 1px;
  }

  .app--dark .mermaid .node.clickable {
      cursor: pointer;
  }

  .app--dark .mermaid .arrowheadPath {
      fill: #d3d3d3;
  }

  .app--dark .mermaid .edgePath .path {
      stroke: #d3d3d3;
      stroke-width: 1.5px;
  }

  .app--dark .mermaid .edgeLabel {
      background-color: #e8e8e8;
  }

  .app--dark .mermaid .cluster rect {
      fill: #6d6d65 !important;
      stroke: hsla(0, 0%, 100%, 0.25) !important;
      stroke-width: 1px !important;
  }

  .app--dark .mermaid .cluster text {
      fill: #f9fffe;
  }

  .app--dark .mermaid div.mermaidTooltip {
      position: absolute;
      text-align: center;
      max-width: 200px;
      padding: 2px;
      font-family: trebuchet ms, verdana, arial;
      font-size: 12px;
      background: #6d6d65;
      border: 1px solid hsla(0, 0%, 100%, 0.25);
      border-radius: 2px;
      pointer-events: none;
      z-index: 100;
  }

  .app--dark .mermaid .actor {
      stroke: #81b1db;
      fill: #bdd5ea;
  }

  .app--dark .mermaid text.actor {
      fill: #000;
      stroke: none;
  }

  .app--dark .mermaid .actor-line {
      stroke: #d3d3d3;
  }

  .app--dark .mermaid .messageLine0 {
      marker-end: "url(#arrowhead)";
  }

  .app--dark .mermaid .messageLine0,
  .app--dark .mermaid .messageLine1 {
      stroke-width: 1.5;
      stroke-dasharray: "2 2";
      stroke: #d3d3d3;
  }

  .app--dark .mermaid #arrowhead {
      fill: #d3d3d3;
  }

  .app--dark .mermaid #crosshead path {
      fill: #d3d3d3 !important;
      stroke: #d3d3d3 !important;
  }

  .app--dark .mermaid .messageText {
      fill: #d3d3d3;
      stroke: none;
  }

  .app--dark .mermaid .labelBox {
      stroke: #81b1db;
      fill: #bdd5ea;
  }

  .app--dark .mermaid .labelText,
  .app--dark .mermaid .loopText {
      fill: #d3d3d3;
      stroke: none;
  }

  .app--dark .mermaid .loopLine {
      stroke-width: 2;
      stroke-dasharray: "2 2";
      marker-end: "url(#arrowhead)";
      stroke: #81b1db;
  }

  .app--dark .mermaid .note {
      stroke: hsla(0, 0%, 100%, 0.25);
      fill: #fff5ad;
  }

  .app--dark .mermaid .noteText {
      fill: #000;
      stroke: none;
      font-family: trebuchet ms, verdana, arial;
      font-size: 14px;
  }

  .app--dark .mermaid .section {
      stroke: none;
      opacity: 0.2;
  }

  .app--dark .mermaid .section0 {
      fill: hsla(0, 0%, 100%, 0.3);
  }

  .app--dark .mermaid .section2 {
      fill: #eae8b9;
  }

  .app--dark .mermaid .section1,
  .app--dark .mermaid .section3 {
      fill: #fff;
      opacity: 0.2;
  }

  .app--dark .mermaid .sectionTitle0,
  .app--dark .mermaid .sectionTitle1,
  .app--dark .mermaid .sectionTitle2,
  .app--dark .mermaid .sectionTitle3 {
      fill: #f9fffe;
  }

  .app--dark .mermaid .sectionTitle {
      text-anchor: start;
      font-size: 11px;
  }

  .app--dark .mermaid .grid .tick {
      stroke: #d3d3d3;
      opacity: 0.3;
      shape-rendering: crispEdges;
  }

  .app--dark .mermaid .grid path {
      stroke-width: 0;
  }

  .app--dark .mermaid .today {
      fill: none;
      stroke: #db5757;
      stroke-width: 2px;
  }

  .app--dark .mermaid .task {
      stroke-width: 2;
  }

  .app--dark .mermaid .taskText {
      text-anchor: middle;
      font-size: 11px;
  }

  .app--dark .mermaid .taskTextOutsideRight {
      fill: #323d47;
      text-anchor: start;
      font-size: 11px;
  }

  .app--dark .mermaid .taskTextOutsideLeft {
      fill: #323d47;
      text-anchor: end;
      font-size: 11px;
  }

  .app--dark .mermaid .taskText0,
  .app--dark .mermaid .taskText1,
  .app--dark .mermaid .taskText2,
  .app--dark .mermaid .taskText3 {
      fill: #323d47;
  }

  .app--dark .mermaid .task0,
  .app--dark .mermaid .task1,
  .app--dark .mermaid .task2,
  .app--dark .mermaid .task3 {
      fill: #bdd5ea;
      stroke: hsla(0, 0%, 100%, 0.5);
  }

  .app--dark .mermaid .taskTextOutside0,
  .app--dark .mermaid .taskTextOutside1,
  .app--dark .mermaid .taskTextOutside2,
  .app--dark .mermaid .taskTextOutside3 {
      fill: #d3d3d3;
  }

  .app--dark .mermaid .active0,
  .app--dark .mermaid .active1,
  .app--dark .mermaid .active2,
  .app--dark .mermaid .active3 {
      fill: #81b1db;
      stroke: hsla(0, 0%, 100%, 0.5);
  }

  .app--dark .mermaid .activeText0,
  .app--dark .mermaid .activeText1,
  .app--dark .mermaid .activeText2,
  .app--dark .mermaid .activeText3 {
      fill: #323d47 !important;
  }

  .app--dark .mermaid .done0,
  .app--dark .mermaid .done1,
  .app--dark .mermaid .done2,
  .app--dark .mermaid .done3 {
      stroke: grey;
      fill: #d3d3d3;
      stroke-width: 2;
  }

  .app--dark .mermaid .doneText0,
  .app--dark .mermaid .doneText1,
  .app--dark .mermaid .doneText2,
  .app--dark .mermaid .doneText3 {
      fill: #323d47 !important;
  }

  .app--dark .mermaid .crit0,
  .app--dark .mermaid .crit1,
  .app--dark .mermaid .crit2,
  .app--dark .mermaid .crit3 {
      stroke: #e83737;
      fill: #e83737;
      stroke-width: 2;
  }

  .app--dark .mermaid .activeCrit0,
  .app--dark .mermaid .activeCrit1,
  .app--dark .mermaid .activeCrit2,
  .app--dark .mermaid .activeCrit3 {
      stroke: #e83737;
      fill: #81b1db;
      stroke-width: 2;
  }

  .app--dark .mermaid .doneCrit0,
  .app--dark .mermaid .doneCrit1,
  .app--dark .mermaid .doneCrit2,
  .app--dark .mermaid .doneCrit3 {
      stroke: #e83737;
      fill: #d3d3d3;
      stroke-width: 2;
      cursor: pointer;
      shape-rendering: crispEdges;
  }

  .app--dark .mermaid .activeCritText0,
  .app--dark .mermaid .activeCritText1,
  .app--dark .mermaid .activeCritText2,
  .app--dark .mermaid .activeCritText3,
  .app--dark .mermaid .doneCritText0,
  .app--dark .mermaid .doneCritText1,
  .app--dark .mermaid .doneCritText2,
  .app--dark .mermaid .doneCritText3 {
      fill: #323d47 !important;
  }

  .app--dark .mermaid .titleText {
      text-anchor: middle;
      font-size: 18px;
      fill: #323d47;
  }

  .app--dark .mermaid g.classGroup text {
      fill: purple;
      stroke: none;
      font-family: trebuchet ms, verdana, arial;
      font-size: 10px;
  }

  .app--dark .mermaid g.classGroup rect {
      fill: #bdd5ea;
      stroke: purple;
  }

  .app--dark .mermaid g.classGroup line {
      stroke: purple;
      stroke-width: 1;
  }

  .app--dark .mermaid .classLabel .box {
      stroke: none;
      stroke-width: 0;
      fill: #bdd5ea;
      opacity: 0.5;
  }

  .app--dark .mermaid .classLabel .label {
      fill: purple;
      font-size: 10px;
  }

  .app--dark .mermaid .relation {
      stroke: purple;
      stroke-width: 1;
      fill: none;
  }

  .app--dark .mermaid #compositionEnd,
  .app--dark .mermaid #compositionStart {
      fill: purple;
      stroke: purple;
      stroke-width: 1;
  }

  .app--dark .mermaid #aggregationEnd,
  .app--dark .mermaid #aggregationStart {
      fill: #bdd5ea;
      stroke: purple;
      stroke-width: 1;
  }

  .app--dark .mermaid #dependencyEnd,
  .app--dark .mermaid #dependencyStart,
  .app--dark .mermaid #extensionEnd,
  .app--dark .mermaid #extensionStart {
      fill: purple;
      stroke: purple;
      stroke-width: 1;
  }

  .app--dark .mermaid .branch-label,
  .app--dark .mermaid .commit-id,
  .app--dark .mermaid .commit-msg {
      fill: #d3d3d3;
      color: #d3d3d3;
  }

  /*! normalize-scss | MIT/GPLv2 License | bit.ly/normalize-scss */
  html {
      line-height: 1.15;
      -ms-text-size-adjust: 100%;
      -webkit-text-size-adjust: 100%;
      scroll-behavior: smooth;
  }

  body {
      margin: 0;
      background-color: #14191F;
  }

  article,
  aside,
  footer,
  header,
  nav,
  section {
      display: block;
  }

  h1 {
      font-size: 2em;
      margin: 0.67em 0;
  }

  figcaption,
  figure {
      display: block;
  }

  figure {
      margin: 1em 40px;
  }

  hr {
      box-sizing: content-box;
      height: 0;
      overflow: visible;
  }

  main {
      display: block;
  }

  pre {
      font-family: monospace, monospace;
      font-size: 1em;
  }

  a {
      background-color: transparent;
      -webkit-text-decoration-skip: objects;
  }

  abbr[title] {
      border-bottom: none;
      text-decoration: underline;
      text-decoration: underline dotted;
  }

  b,
  strong {
      font-weight: inherit;
      font-weight: bolder;
  }

  code,
  kbd,
  samp {
      font-family: monospace, monospace;
      font-size: 1em;
  }

  dfn {
      font-style: italic;
  }

  mark {
      background-color: #ff0;
      color: #000;
  }

  small {
      font-size: 80%;
  }

  sub,
  sup {
      font-size: 75%;
      line-height: 0;
      position: relative;
      vertical-align: baseline;
  }

  sub {
      bottom: -0.25em;
  }

  sup {
      top: -0.5em;
  }

  audio,
  video {
      display: inline-block;
  }

  audio:not([controls]) {
      display: none;
      height: 0;
  }

  img {
      border-style: none;
  }

  svg:not(:root) {
      overflow: hidden;
  }

  button,
  input,
  optgroup,
  select,
  textarea {
      font-family: sans-serif;
      font-size: 100%;
      line-height: 1.15;
      margin: 0;
  }

  button {
      overflow: visible;
  }

  button,
  select {
      text-transform: none;
  }

  [type="reset"],
  [type="submit"],
  button,
  html [type="button"] {
      -webkit-appearance: button;
  }

  [type="button"]::-moz-focus-inner,
  [type="reset"]::-moz-focus-inner,
  [type="submit"]::-moz-focus-inner,
  button::-moz-focus-inner {
      border-style: none;
      padding: 0;
  }

  [type="button"]:-moz-focusring,
  [type="reset"]:-moz-focusring,
  [type="submit"]:-moz-focusring,
  button:-moz-focusring {
      outline: 1px dotted ButtonText;
  }

  input {
      overflow: visible;
  }

  [type="checkbox"],
  [type="radio"] {
      box-sizing: border-box;
      padding: 0;
  }

  [type="number"]::-webkit-inner-spin-button,
  [type="number"]::-webkit-outer-spin-button {
      height: auto;
  }

  [type="search"] {
      -webkit-appearance: textfield;
      outline-offset: -2px;
  }

  [type="search"]::-webkit-search-cancel-button,
  [type="search"]::-webkit-search-decoration {
      -webkit-appearance: none;
  }

  ::-webkit-file-upload-button {
      -webkit-appearance: button;
      font: inherit;
  }

  fieldset {
      padding: 0.35em 0.75em 0.625em;
  }

  legend {
      box-sizing: border-box;
      display: table;
      max-width: 100%;
      padding: 0;
      color: inherit;
      white-space: normal;
  }

  progress {
      display: inline-block;
      vertical-align: baseline;
  }

  textarea {
      overflow: auto;
  }

  details {
      display: block;
  }

  summary {
      display: list-item;
  }

  menu {
      display: block;
  }

  canvas {
      display: inline-block;
  }

  [hidden],
  template {
      display: none;
  }

  body,
  html {
      color: #a8a8a8f4;
      font-size: 16px;
      font-family: Lato, Helvetica Neue, Helvetica, sans-serif;
      font-variant-ligatures: common-ligatures;
      line-height: 1.67;
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
  }

  .app--dark .layout__panel--editor,
  .app--dark .layout__panel--preview {
      color: hsla(0, 0%, 100%, 0.75);
  }

  blockquote,
  dl,
  ol,
  p,
  pre,
  ul {
      margin: 1.2em 0;
  }

  h1,
  h2,
  h3,
  h4,
  h5,
  h6 {
      margin: 1.8em 0;
      line-height: 1.33;
  }

  h1:after,
  h2:after {
      content: "";
      display: block;
      position: relative;
      top: 0.33em;
      border-bottom: 1px solid hsla(0, 0%, 50%, 0.33);
  }

  ol ol,
  ol ul,
  ul ol,
  ul ul {
      margin: 0;
  }

  dt {
      font-weight: 700;
  }

  a {
      color: #00C79A;
      text-decoration: underline dotted;
  }

  a:focus,
  a:hover {
      text-decoration: none;
  }

  code,
  pre,
  samp {
      font-family: Roboto Mono, Lucida Sans Typewriter, Lucida Console, monaco,
          Courrier, monospace;
      font-size: 0.85em;
  }

  code *,
  pre *,
  samp * {
      font-size: inherit;
  }

  blockquote {
      color: #00C79A;
      padding-left: 1.5em;
      border-left: 5px solid #00C79A;
  }

  .app--dark .layout__panel--editor blockquote,
  .app--dark .layout__panel--preview blockquote {
      color: hsla(0, 0%, 100%, 0.4);
      border-left-color: hsla(0, 0%, 100%, 0.1);
  }

  code {
      background-color: rgba(0, 0, 0, 0.05);
      border-radius: 3px;
      padding: 2px 4px;
  }

  hr {
      border: 0;
      border-top: 1px solid hsla(0, 0%, 50%, 0.33);
      margin: 2em 0;
  }

  pre>code {
      background-color: rgba(0, 0, 0, 0.05);
      display: block;
      padding: 0.5em;
      -webkit-text-size-adjust: none;
      overflow-x: auto;
      white-space: pre;
  }

  .toc ul {
      list-style-type: none;
      padding-left: 20px;
  }

  table {
      background-color: transparent;
      border-collapse: collapse;
      border-spacing: 0;
  }

  td,
  th {
      border-right: 1px solid #dcdcdc;
      padding: 8px 12px;
  }

  td:last-child,
  th:last-child {
      border-right: 0;
  }

  td {
      border-top: 1px solid #dcdcdc;
  }

  mark {
      background-color: #f8f840;
  }

  kbd {
      font-family: Lato, Helvetica Neue, Helvetica, sans-serif;
      background-color: #fff;
      border: 1px solid rgba(63, 63, 63, 0.25);
      border-radius: 3px;
      box-shadow: 0 1px 0 rgba(63, 63, 63, 0.25);
      color: #333;
      display: inline-block;
      font-size: 0.8em;
      margin: 0 0.1em;
      padding: 0.1em 0.6em;
      white-space: nowrap;
  }

  abbr[title] {
      border-bottom: 1px dotted #777;
      cursor: help;
  }

  img {
      max-width: 100%;
  }

  .task-list-item {
      list-style-type: none;
  }

  .task-list-item-checkbox {
      margin: 0 0.2em 0 -1.3em;
  }

  .footnote {
      font-size: 0.8em;
      position: relative;
      top: -0.25em;
      vertical-align: top;
  }

  .page-break-after {
      page-break-after: always;
  }

  .abc-notation-block {
      overflow-x: auto !important;
  }

  .dashed__html {
      margin-bottom: 180px;
      margin-left: auto;
      margin-right: auto;
      padding-left: 30px;
      padding-right: 30px;
      max-width: 750px;
  }

  .dashed__toc ul {
      padding: 0;
  }

  .dashed__toc ul a {
      margin: 0.5rem 0;
      padding: 0.5rem 1rem;
  }

  .dashed__toc ul ul {
      color: #888;
      font-size: 0.9em;
  }

  .dashed__toc ul ul a {
      margin: 0;
      padding: 0.1rem 1rem;
  }

  .dashed__toc li {
      display: block;
  }

  .dashed__toc a {
      display: block;
      color: inherit;
      text-decoration: none;
  }

  .dashed__toc a:active,
  .dashed__toc a:focus,
  .dashed__toc a:hover {
      background-color: rgba(0, 0, 0, 0.075);
      border-radius: 3px;
  }

  .dashed__left {
      position: fixed;
      display: none;
      width: 250px;
      height: 100%;
      top: 0;
      left: 0;
      overflow-x: hidden;
      overflow-y: auto;
      -webkit-overflow-scrolling: touch;
      -ms-overflow-style: none;
  }

  @media (min-width: 1060px) {
      .dashed__left {
          display: block;
      }
  }

  .dashed__right {
      position: absolute;
      right: 0;
      top: 0;
      left: 0;
  }

  @media (min-width: 1060px) {
      .dashed__right {
          left: 250px;
      }
  }

  .dashed--pdf blockquote {
      border-left-color: #ececec;
  }

  .dashed--pdf .dashed__html {
      padding-left: 0;
      padding-right: 0;
      max-width: none;
  }

  .warning {
      padding: 14px;
      background-color: #ff0000;
      color: black;
      font-weight: bolder;
      font-size: large;
  }

  .info {
      padding: 14px;
      background-color: #0c93e4;
      color: black;
      font-weight: bolder;
      font-size: large;
  }

  .success {
      padding: 14px;
      background-color: #00bb00;
      color: #000;
      font-weight: bolder;
      font-size: large;
      text-align: center;
  }
  .success a {
      text-decoration: underline dotted #333;
      color: #111
  }

  .rule-breaker {
      padding: 5px;
      border: solid red;
      border-radius: 5px;
  }

  .noselect {
      user-select: none;
  }
    </style>
  </head>

  <body class="dashed app--dark">
    <div class="dashed__left">
      <div class="dashed__toc">
        <ul>
          <li>
            <a href="#hello-world">Hello World</a>
            <ul>
              <li><a href="#public-url">Public URL</a></li>
              <li><a href="#private-url">Private URL</a></li>
            </ul>
          </li>
          <li><a href="#db-config">DB Config</a></li>
          <li>
            <a href="#technical-setup">Technical Setup</a>
            <ul>
              <li>
                <ul>
                  <li><a href="#ssh-access">SSH Access</a></li>
                  <li><a href="#manage-credentials">Manage Credentials</a></li>
                  <li><a href="#enabling-other-hidden-services">Enabling Other Hidden Services</a></li>
                  <li><a href="#vanity-urls">Vanity URLS</a></li>
                </ul>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
    <div class="dashed__right">
      <div class="dashed__html">
        <h1 id="hello-world">Hello World</h1>
        <p>
          Yo - so you made it this far… good work. Wondering what to do now?
        </p>
        <p>Well, your server has a two links. It has:</p>
        <ol>
          <li>
            <strong>A public link</strong> &gt;&gt; <a href="http://'.$public.'">'.$public.'</a> &lt;&lt; where your site actually is available at.
          </li>
          <li>
            And <strong>a private link</strong> &gt;&gt; <a
              href="http://'.$private.'"
              >'.$private.'</a> &lt;&lt; where you will find your own self-hosted file manager. You
            can use this to easily edit your web directory, create/modify/delete
            files with a web-based fancy text editor, and much more.
          </li>
        </ol>
        <p>
          <mark> Warning: </mark>
          <strong
            >You <u>must</u> enable javascript for this manager. As it is on
            your own server space you can trust it. Do not alter the torrc
            record for this site or it could break.</strong
          >
        </p>
        <h2 id="public-url">Public URL</h2>
        <p>
          <strong>Description</strong><br />
          This is where your site will be accessible. You can manage it from
          your <em>Private URL</em>. You can serve PHP and HTML files to this
          URL. It is only for your public website. Use responsibly.
        </p>
        <p>
          <strong>Vanity URL</strong><br />
          If you have a vanity URL you wish to use, or you wish to make one, the
          procedure is explained below, as is how to set up multiple sites on
          your server. We do not provide support for vanity v2 addresses at this
          time.<br>
          <mark> This is the most commonly messed up endeavor on my services. If you start messing with Vanity URLS and do not implement them properly - you will break your access to your server (you will break tor altogether). </mark>
        </p>
        <h2 id="private-url">Private URL</h2>
        <p>
          <strong>Description</strong><br />
          This is the most important url. It is your gateway to managing your
          website, the one that appears on the Public URL. It acts as your:
        </p>
        <ul>
          <li>File manager address; and</li>
          <li>SSH address</li>
        </ul>
        <p>
          <mark
            > As such, you should keep this URL private. Do not share it with
            others, except people who need them (collaborators, etc.) </mark
          >
        </p>
        <p>
          <strong>Defualt user and password</strong><br />
          Your default user is <code>jack</code> and your default password is
          <code>minnty</code>.
        </p>
        <p>
          <strong>Creditial Usage</strong><br />
          You can use these to login to both the file manager and your server
          via ssh. You can change your username or password
          <strong>for the file manager</strong> in the config.php file in the
          /var/www/html/.files directory. Your username and password for SSH can
          be changed (see
          <a href="#manage-credentials">Manage Credentials</a> below), but as
          you are keeping your Private URL private, you mightn’t need to. It’s
          up to you. My advice is do, just in case, but don’t if you’re just
          gonna mess up the server.
        </p>
        <h1 id="db-config">Database Configuration</h1>
<p>Your database details are as follows:</p>

<table>
<thead>
<tr>
<th>Field</th>
<th>Value</th>
</tr>
</thead>
<tbody>
<tr>
<td>DBTYPE</td>
<td>MySQL</td>
</tr>
<tr>
<td>DBHOST</td>
<td>';
if($dbhost="db.sokka.io") {
  echo '<a href="https://db.sokka.io" target="_blank">db.sokka.io</a> (you can manage with phpmyadmin/adminer here also)';
}else{
  echo $dbhost;
}
echo '</td></tr>
<tr>
<td>DBPORT</td>
<td>'.$dbport.'</td>
</tr>
<tr>
<td>DBNAME</td>
<td>'.$dbname.'</td>
</tr>
<tr>
<td>DBUSER</td>
<td>'.$dbuser.'</td>
</tr>
<tr>
<td>DBPASS</td>
<td>'.$dbpass.'</td>
</tr>
</tbody>
</table>
<p>If you need more, just ask Dasho and he will get you one in no time!</p>
        <h1 id="technical-setup">Technical Setup</h1>
        <h3 id="ssh-access">SSH Access (The Easy Way)</h3>
        <p>There are two ways.</p>
        <ol>
        <li>Go to <a href="http://'.$private.':24">http://'.$private.':24</a> and login with your credentials; or if that does not work (and it might not)</li>
        <li>Do the longer method explained below.</li>
        </ol>
        <h3 id="ssh-access">SSH Access (The Longer Way)</h3>
        <p><strong>Prerequisites</strong></p>
        <pre
          class="language-bash"
        ><code class="prism  language-bash"><span class="noselect">$ <span class="token operator">|</span> </span><span class="token function">sudo</span> apt update
<span class="noselect">$ <span class="token operator">|</span> </span><span class="token function">sudo</span> apt <span class="token function">install</span> tor</code></pre>
        <p><strong>To SSH in</strong></p>
        <pre
          class="language-bash"
        ><code class="prism  language-bash"><span class="noselect">$ <span class="token operator">|</span> </span><span class="token function">sudo</span> <span class="token function">service</span> tor start
<span class="noselect">$ <span class="token operator">|</span> </span>torsocks <span class="token function">ssh</span> jack@'.$private.'</code></pre>
        <p>This will result in:</p>
        <pre
          class="language-bash"
        ><code class="prism  language-bash">The authenticity of host <span class="token string">\''.$private.' (x.x.x.x)\'</span> can\'t be established.
ECDSA key fingerprint is SHA256:XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX.
Are you sure you want to continue connecting <span class="token punctuation">(</span>yes/no/<span class="token punctuation">[</span>fingerprint<span class="token punctuation">]</span><span class="token punctuation">)</span>?</code></pre>
        <p>Type <code>yes</code> and continute to enter your password:</p>
        <pre
          class="language-bash"
        ><code class="prism  language-bash">Warning: Permanently added <span class="token string">\''.$private.'\'</span> <span class="token punctuation">(</span>ECDSA<span class="token punctuation">)</span> to the list of known hosts.
<span class="noselect">$ <span class="token operator">|</span> jack@<span class="token variable">'.$private.'</span>\'s password:</span>
</code></pre>
        <p>Then you’re in.</p>
        <h3 id="manage-credentials">Manage Credentials</h3>
        <p>
          <strong>File Manager</strong><br />
          If you want to change your file manager password, first generate a
          password hash @ <a href="https://phppasswordhash.com/" target="_blank">https://phppasswordhash.com/</a>:
        </p>
        <p>
          Copy you password hash and go to
          <code>/var/www/html/.files/</code> via SSH and run
          <code>nano config.php</code>. Once you do this you will see a
          configuration file. Go to line 17. You should see this on line 17 to
          19:
        </p>
        <pre><code>$auth_users = array(
	\'jack\' =&gt; \'$2y$10$wlHkp7M.BNeh7CRbSamb4.NZJm5XKTw31HDfEAFyHk9frmTtgzg0i\', //password: minnty
);
</code></pre>
        <p>
          Simply change the <code>\'jack\'</code> string to the username you’d
          like to use and the <code>\'$2y$10...\'</code> string to the the
          password hash you just coppied.
        </p>
        <p>
          <strong>SSH</strong><br />
          This one takes advantage of the fact you have root access. Simply
          login via SSH using your <code>jack</code> and
          <code>minnty</code> credentials, then run the following:
        </p>
        <pre><code><span class="noselect">$ | </span>su
<span class="noselect"># | </span>passwd jack
&lt;Enter_Complicate_Password_That_You_Don\'t_Need&gt;
<span class="noselect"># | </span>useradd -d /var/html/www/.files/1 &lt;NEW_USERNAME&gt;
<span class="noselect"># | </span>passwd &lt;NEW_USERNAME&gt;
&lt;Enter_Hard_To_Guess_Easy_To_Remember_Password_That_You_Want_To_Use&gt;
</code></pre>
        <p>
          And that’s it. <mark> <strong>DO NOT</strong> use the </mark>
          <code>usermod -l &lt;NEW_USERNAME&gt; jack</code>
          <mark> command. It wont work with my setup. </mark>
        </p>
        <h3 id="enabling-other-hidden-services">
          Enabling Other Hidden Services
        </h3>
        <p>
          Just login to your file manager and create a new root site. You will see that there is already a site <code>0</code>, so just create a folder called <code>1</code> and upload your web files there. You can run <code>cat /var/lib/tor/1/hostname</code> to get the url for this site. You can repeat for sites 0-8, after which you will need to contact me to enable a wider setup scheme.</p>
        <h3 id="vanity-urls">Vanity URLS</h3>
        <p><strong>To make a vanity URL</strong></p>
        <pre
          class="language-bash"
        ><code class="prism  language-bash"><span class="noselect">$ <span class="token operator">|</span> </span><span class="token function">cd</span> /var/www/html/.files/.vanity-urls
<span class="noselect">$ <span class="token operator">|</span> </span>./autogen.sh
<span class="noselect">$ <span class="token operator">|</span> </span>./configure 
<span class="noselect">$ <span class="token operator">|</span> </span><span class="token function">make</span>
<span class="noselect">$ <span class="token operator">|</span> </span>./mkp224o -d <span class="token operator">&lt;</span>VURL<span class="token operator">&gt;</span>.keys <span class="token operator">&lt;</span>VURL<span class="token operator">&gt;</span>
</code></pre>
        <p>
          where &lt;VURL&gt; represents the first string of letters/numbers you
          want in your Vanity URL.
          <strong
            >You <u>cannot</u> have the following in your &lt;VURL&gt;:</strong
          >
          <code>1</code
          >,<code>2</code>,<code>7</code>,<code>8</code>,<code>9</code>. These
          digits do not exist in base32 encodings.
        </p>
        <p>This will start to create your url.</p>
        <p>
          <strong>How long should it take?</strong><br />
          It depends on pure luck, as it just tries combinations at random. On
          average though, it will be similar to the answer of the formula
          below:<br />
          &nbsp;&nbsp;&nbsp;32<sup>Length of Prefix</sup> ÷ 924,000,000 ≈ Time
          in minutes<br />
          For example, a 7-character prefix would be<br />
          &nbsp;&nbsp;&nbsp;32<sup>7</sup> ÷ 924,000,000 ≈ 37 mins.<br />
          This is only an estimation though, and does not reflect the actual
          time. A 7-character prefix could take anything from 5 mins to a day.
          It only represents the time it should take, not will take.
        </p>
        <blockquote>
          <p>
            <strong>The shorter the prefix, the faster the generation.</strong>
          </p>
        </blockquote>
        <p>
          <strong>To implement my vanity URL</strong><br />
          <mark> <em>Please run these commands exactly as shown. <strong>DO NOT</strong> try to copy and paste the files over in any other manner or rename stuff or anything. You will mess up the permissions that tor needs to run and you will break tor, and you will make it impossible to get back in without my assistance. I will be reluctant.</em> </mark><br />
          Once you have a vanity URL, cd into the directory where it is. That is
          where you find the file named <code>hostname</code>. Then run
        </p>
        <pre
          class="language-bash"
        ><code class="prism  language-bash"><span class="noselect">$ <span class="token operator">|</span> </span><span class="token function">cat</span>  hs_ed25519_secret_key <span class="token operator">&gt;</span> /var/lib/tor/<span class="token operator">&lt;</span>SITE<span class="token operator">&gt;</span>/hs_ed25519_secret_key
<span class="noselect">$ <span class="token operator">|</span> </span><span class="token function">rm</span> /var/lib/tor/<span class="token operator">&lt;</span>SITE<span class="token operator">&gt;</span>/hostname
<span class="noselect">$ <span class="token operator">|</span> </span><span class="token function">rm</span> /var/lib/tor/<span class="token operator">&lt;</span>SITE<span class="token operator">&gt;</span>/hs_ed25519_public_key
<span class="noselect">$ <span class="token operator">|</span> </span><span class="token function">rm</span> -r /var/lib/tor/<span class="token operator">&lt;</span>SITE<span class="token operator">&gt;</span>/authorized_clients
</code></pre>
        <p>Finally, you need to restart your server. Do this at the <a href="'.$manager.'" target="_blank">Dashed Droplet Manager</a>. You will need your project_codename and your 2FA Code!</p>
        <hr />
        <p>
          Powered by Dashed Droplets (v4) - Contact me if you require help (<a
            href="mailto:support@sokka.io"
            >support@sokka.io</a
          > or <a href="http://sonarmsng5vzwqezlvtu2iiwwdn3dxkhotftikhowpfjuzg7p3ca5eid.onion/contact/Dasho">Sonar</a>).
        </p>
      </div>
    </div>
  </body>
</html>';

?>
