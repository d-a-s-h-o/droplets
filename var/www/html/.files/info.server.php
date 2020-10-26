<?php
$private = file_get_contents('/var/www/dump/files.hostname');
$public = file_get_contents('/var/www/html/onion.url');
$admin = 'http://cboxkuuxrtulkkxhod2pxo3la25tztcp4cdjmc75wc5airqqliq2srad.onion/';

echo '<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Server Hosting Information</title>
    <link rel="shortcut icon" type="image/png" href="http://'.$private.'/host.png" id="favicon" />
    <style type="text/css">
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
      } /*! normalize-scss | MIT/GPLv2 License | bit.ly/normalize-scss */
      html {
        line-height: 1.15;
        -ms-text-size-adjust: 100%;
        -webkit-text-size-adjust: 100%;
      }
      body {
        margin: 0;
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
        color: rgba(0, 0, 0, 0.75);
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
        color: #0c93e4;
        text-decoration: underline;
        text-decoration-skip: ink;
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
        color: rgba(0, 0, 0, 0.5);
        padding-left: 1.5em;
        border-left: 5px solid rgba(0, 0, 0, 0.1);
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
      pre > code {
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
      .chost__html {
        margin-bottom: 180px;
        margin-left: auto;
        margin-right: auto;
        padding-left: 30px;
        padding-right: 30px;
        max-width: 750px;
      }
      .chost__toc ul {
        padding: 0;
      }
      .chost__toc ul a {
        margin: 0.5rem 0;
        padding: 0.5rem 1rem;
      }
      .chost__toc ul ul {
        color: #888;
        font-size: 0.9em;
      }
      .chost__toc ul ul a {
        margin: 0;
        padding: 0.1rem 1rem;
      }
      .chost__toc li {
        display: block;
      }
      .chost__toc a {
        display: block;
        color: inherit;
        text-decoration: none;
      }
      .chost__toc a:active,
      .chost__toc a:focus,
      .chost__toc a:hover {
        background-color: rgba(0, 0, 0, 0.075);
        border-radius: 3px;
      }
      .chost__left {
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
        .chost__left {
          display: block;
        }
      }
      .chost__right {
        position: absolute;
        right: 0;
        top: 0;
        left: 0;
      }
      @media (min-width: 1060px) {
        .chost__right {
          left: 250px;
        }
      }
      .chost--pdf blockquote {
        border-left-color: #ececec;
      }
      .chost--pdf .chost__html {
        padding-left: 0;
        padding-right: 0;
        max-width: none;
      }
    </style>
  </head>

  <body class="chost app--dark">
    <div class="chost__left">
      <div class="chost__toc">
        <ul>
          <li>
            <a href="#hello-world">Hello World</a>
            <ul>
              <li><a href="#public-url">Public URL</a></li>
              <li><a href="#private-url">Private URL</a></li>
            </ul>
          </li>
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
    <div class="chost__right">
      <div class="chost__html">
        <h1 id="hello-world">Hello World</h1>
        <p>
          Yo - so you made it this far… good work. Wondering what to do now?
        </p>
        <p>Well, your server has a two links. It has:</p>
        <ol>
          <li>
            <strong>A public link</strong> &gt;&gt; <a href="http://'.$public.'">'.$public.'</a>&lt;&lt; where your site actually is available at.
          </li>
          <li>
            And <strong>a private link</strong> &gt;&gt; <a
              href="http://'.$private.'"
              >'.$private.'</a>&lt;&lt; where you will find your own self-hosted file manager. You
            can use this to easily edit your web directory, create/modify/delete
            files with a web-based fancy text editor, and much more.
          </li>
        </ol>
        <p>
          <mark>Warning:</mark>
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
          time.
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
            >As such, you should keep this URL private. Do not share it with
            others, except people who need them (collaborators, etc.)</mark
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
        <h1 id="technical-setup">Technical Setup</h1>
        <h3 id="ssh-access">SSH Access</h3>
        <p><strong>Prerequisites</strong></p>
        <pre
          class="language-bash"
        ><code class="prism  language-bash">$ <span class="token operator">|</span> <span class="token function">sudo</span> apt update
$ <span class="token operator">|</span> <span class="token function">sudo</span> apt <span class="token function">install</span> tor</code></pre>
        <p><strong>To SSH in</strong></p>
        <pre
          class="language-bash"
        ><code class="prism  language-bash">$ <span class="token operator">|</span> <span class="token function">sudo</span> <span class="token function">service</span> tor start
$ <span class="token operator">|</span> torsocks <span class="token function">ssh</span> jack@.'.$private.'</code></pre>
        <p>This will result in:</p>
        <pre
          class="language-bash"
        ><code class="prism  language-bash">The authenticity of host <span class="token string">\''.$private.' (x.x.x.x)\'</span> can\'t be established.
ECDSA key fingerprint is SHA256:ZKwWuURAZp6O5wcSFyswbNigaTSAIP3uf77w6w7lss8.
Are you sure you want to continue connecting <span class="token punctuation">(</span>yes/no/<span class="token punctuation">[</span>fingerprint<span class="token punctuation">]</span><span class="token punctuation">)</span>?</code></pre>
        <p>Type <code>yes</code> and continute to enter your password:</p>
        <pre
          class="language-bash"
        ><code class="prism  language-bash">Warning: Permanently added <span class="token string">\''.$private.'\'</span> <span class="token punctuation">(</span>ECDSA<span class="token punctuation">)</span> to the list of known hosts.
$ <span class="token operator">|</span> jack@.<span class="token variable">'.$private.'</span>\'s password:
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
          <code>/var/www/html/.files/</code> via the terminal and run
          <code>nano config.php</code>. One you do this you will see a
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
        <pre><code>$ | su
# | passwd jack
&lt;Enter_Complicate_Password_That_You_Don\'t_Need&gt;
# | useradd -d /var/html/www/.files/1 &lt;NEW_USERNAME&gt;
# | passwd &lt;NEW_USERNAME&gt;
&lt;Enter_Hard_To_Guess_Easy_To_Remember_Password_That_You_Want_To_Use&gt;
</code></pre>
        <p>
          And that’s it. <mark><strong>DO NOT</strong> use the</mark>
          <code>usermod -l &lt;NEW_USERNAME&gt; jack</code>
          <mark>command. It wonk work with my setup.</mark>
        </p>
        <h3 id="enabling-other-hidden-services">
          Enabling Other Hidden Services
        </h3>
        <p>
          Once again, just SSH into your vps and then edit
          <code>/etc/tor/torrc/</code> from:
        </p>
        <pre><code>#HiddenServiceDir /var/lib/tor/2
#HiddenServicePort 80 127.0.0.1:81
</code></pre>
        <p>to:</p>
        <pre><code>HiddenServiceDir /var/lib/tor/2
HiddenServicePort 80 127.0.0.1:81
</code></pre>
        <p>
          (i.e) uncomment the sites you want to create. Then go over to the
          <a href="'.$admin.'" target="_blank">Chatterbox</a> and ask @Curious to restart your server.
        </p>
        <h3 id="vanity-urls">Vanity URLS</h3>
        <p><strong>To make a vanity URL</strong></p>
        <pre
          class="language-bash"
        ><code class="prism  language-bash">$ <span class="token operator">|</span> <span class="token function">cd</span> /var/www/html/.files/.vanity-urls
$ <span class="token operator">|</span> ./mkp224o -d <span class="token operator">&lt;</span>VURL<span class="token operator">&gt;</span>.keys <span class="token operator">&lt;</span>VURL<span class="token operator">&gt;</span>
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
          Once you have a vanity URL, cd into the directory where it is. That is
          where you find the file named <code>hostname</code>. Then run
        </p>
        <pre
          class="language-bash"
        ><code class="prism  language-bash">$ <span class="token operator">|</span> <span class="token function">cat</span>  hs_ed25519_secret_key <span class="token operator">&gt;</span> /var/lib/tor/<span class="token operator">&lt;</span>SITE<span class="token operator">&gt;</span>/hs_ed25519_secret_key
$ <span class="token operator">|</span> <span class="token function">rm</span> /var/lib/tor/<span class="token operator">&lt;</span>SITE<span class="token operator">&gt;</span>/hostname
$ <span class="token operator">|</span> <span class="token function">rm</span> /var/lib/tor/<span class="token operator">&lt;</span>SITE<span class="token operator">&gt;</span>/hs_ed25519_public_key
$ <span class="token operator">|</span> <span class="token function">rm</span> -r /var/lib/tor/<span class="token operator">&lt;</span>SITE<span class="token operator">&gt;</span>/authorized_clients
</code></pre>
        <p>Finally, you need to restart tor. Ask @Curious to do this at <a href="'.$admin.'" target="_blank">Chatterbox. If he\'s offline, just leave him an offline message and he will do it when he\'s back online.</a>.</p>
        <hr />
        <p>
          Powered by Hidden Hosting (v1) - Contact me if you require help (<a
            href="mailto:curious@null.net"
            >curious@null.net</a
          >). I\'m already working on version two with an admin portal where you can turn on/off your server and restart it yourself.
        </p>
      </div>
    </div>
  </body>
</html>';

?>