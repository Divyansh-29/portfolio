<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <meta name="theme-color" content="#11110f" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta
      name="description"
      content="{{ $settings['meta_description'] ?? 'Portfolio of Divyansh Chawla, UI/UX designer and web developer.' }}"
    />
    <title>{{ $settings['site_title'] ?? 'Divyansh Chawla — UI/UX Designer & Web Developer' }}</title>
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wdth,wght@12..96,75..100,400..800&family=DM+Mono:wght@400;500&family=Manrope:wght@400;500;600;700;800&family=Playfair+Display:ital,wght@0,600;0,700;1,600&display=swap"
      rel="stylesheet"
    />
    <style>
      :root {
        --ink: #11110f;
        --paper: #f6f4ee;
        --lime: #d8ff45;
        --orange: #ff6b35;
        --muted: #686862;
        --line: rgba(17, 17, 15, 0.16);
        --cobalt: #4558ff;
        --sky: #8ddcff;
        --violet: #cbb7ff;
        --pink: #ff8fbc;
        --mint: #a6efd1;
      }
      * {
        box-sizing: border-box;
      }
      html {
        scroll-behavior: smooth;
      }
      body {
        margin: 0;
        background: #faf8f0;
        background-image: radial-gradient(rgba(69, 88, 255, 0.055) 1px, transparent 1px);
        background-size: 26px 26px;
        color: var(--ink);
        font: 16px Manrope, sans-serif;
        overflow-x: hidden;
      }
      a {
        color: inherit;
        text-decoration: none;
      }
      .wrap {
        width: min(1240px, calc(100% - 64px));
        margin: auto;
      }
      .mono {
        font: 500 11px/1.2 "DM Mono", monospace;
        letter-spacing: 0.07em;
        text-transform: uppercase;
      }
      .nav {
        height: 82px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 1px solid rgba(69, 88, 255, 0.34);
        position: relative;
      }
      .nav:after {
        content: "";
        position: absolute;
        top: 81px;
        left: 0;
        width: 31vw;
        height: 3px;
        background: linear-gradient(90deg, var(--orange), var(--pink), var(--cobalt));
      }
      .brand {
        display: flex;
        gap: 12px;
        align-items: center;
        font-weight: 800;
        letter-spacing: -0.055em;
        font-size: 20px;
        font-family: "Bricolage Grotesque", sans-serif;
        font-variation-settings: "wdth" 90;
      }
      .brand i {
        width: 13px;
        height: 13px;
        border-radius: 50%;
        background: var(--cobalt);
        box-shadow: 7px 0 0 var(--orange);
      }
      .links {
        display: flex;
        gap: 28px;
        color: #3e3e39;
      }
      .links a:hover {
        color: var(--orange);
      }
      .cta,
      .button {
        border: 1px solid var(--ink);
        padding: 11px 17px;
        display: inline-flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
        font: 600 13px/1 "DM Mono", monospace;
        letter-spacing: 0.04em;
        text-transform: uppercase;
        cursor: pointer;
        transition: 0.2s;
      }
      .cta {
        border-radius: 99px;
        background: var(--lime);
        box-shadow: 3px 3px 0 var(--cobalt);
      }
      .cta:hover,
      .dark:hover {
        background: var(--cobalt);
        color: #fff;
        border-color: var(--cobalt);
        box-shadow: 5px 5px 0 var(--orange);
      }
      .button {
        border-radius: 3px;
      }
      .button.dark {
        background: var(--cobalt);
        color: #fff;
        border-color: var(--cobalt);
        box-shadow: 5px 5px 0 var(--pink);
      }
      .button.light {
        background: #fffdf8;
        box-shadow: 4px 4px 0 var(--lime);
      }
      .hero {
        padding: 108px 0 80px;
        display: grid;
        grid-template-columns: 1.4fr 1fr;
        gap: 40px;
        align-items: center;
        min-height: calc(100vh - 82px);
        position: relative;
      }
      .hero > .reveal,
      .hero-side {
        position: relative;
        z-index: 2;
      }
      .hero:before {
        content: "";
        position: absolute;
        width: 118px;
        height: 118px;
        border-radius: 50% 47% 55% 42%;
        background: var(--pink);
        right: 43%;
        top: 88px;
        opacity: 0.45;
        mix-blend-mode: multiply;
        animation: blob-hop 6s ease-in-out infinite alternate;
      }
      .hero:after {
        content: "made with good chaos";
        position: absolute;
        left: 3%;
        bottom: 37px;
        color: var(--cobalt);
        font: 500 10px "DM Mono", monospace;
        text-transform: uppercase;
        transform: rotate(-7deg);
      }
      h1,
      .head h2,
      .statement p,
      .copy h3,
      .contact h2 {
        font-family: "Bricolage Grotesque", Manrope, sans-serif;
        font-variation-settings: "wdth" 92, "opsz" 72;
      }
      h1 {
        position: relative;
        max-width: 900px;
        font-size: clamp(3.2rem, 7vw, 6.2rem);
        line-height: 0.92;
        letter-spacing: -0.08em;
        margin: 18px 0 24px;
      }
      h1:after {
        content: "✦";
        position: absolute;
        top: -0.2em;
        right: -0.38em;
        color: var(--cobalt);
        font: 400 0.28em/1 "DM Mono", monospace;
        transform: rotate(13deg);
      }
      h1 em,
      h2 em {
        color: var(--cobalt);
        text-decoration: underline wavy var(--orange) 2px;
        text-underline-offset: 0.13em;
      }
      .hero-copy {
        font-size: clamp(17px, 1.35vw, 20px);
        line-height: 1.5;
        max-width: 580px;
        color: var(--muted);
        margin: 0 0 38px;
      }
      .actions {
        display: flex;
        gap: 16px;
        flex-wrap: wrap;
      }
      .hero-side {
        display: flex;
        justify-content: flex-end;
      }
      .orbit {
        position: relative;
        width: 340px;
        height: 340px;
        border-radius: 50%;
        display: grid;
        place-items: center;
        border: 2px dashed var(--cobalt);
        background: radial-gradient(circle at 30% 25%, var(--lime) 0 8%, transparent 8.2%),
          repeating-radial-gradient(circle at center, transparent 0 41px, rgba(69, 88, 255, 0.2) 42px 43px);
      }
      .orbit b {
        background: var(--cobalt);
        color: #fff;
        font-weight: 800;
        font-size: 19px;
        letter-spacing: -0.04em;
        width: 142px;
        height: 142px;
        border-radius: 50%;
        display: grid;
        place-items: center;
        text-align: center;
        box-shadow: 10px 10px 0 var(--orange);
      }
      .note {
        position: absolute;
        border: 1px solid var(--ink);
        padding: 7px 11px;
        font: 500 11px "DM Mono", monospace;
        letter-spacing: 0.05em;
        text-transform: uppercase;
        background: var(--pink);
        box-shadow: 4px 4px 0 var(--ink);
      }
      .note.one {
        top: 20px;
        right: -8px;
        transform: rotate(8deg);
      }
      .note.two {
        bottom: 25px;
        left: -14px;
        transform: rotate(-10deg);
        background: var(--mint);
      }
      .marquee {
        background: linear-gradient(90deg, var(--lime), var(--sky), var(--violet), var(--pink), var(--lime));
        border-top: 1px solid var(--cobalt);
        border-bottom: 1px solid var(--cobalt);
        overflow: hidden;
        white-space: nowrap;
        padding: 13px 0;
        font: 700 14px "DM Mono", monospace;
        letter-spacing: 0.12em;
        display: flex;
      }
      .marquee div {
        animation: marquee 24s linear infinite;
        display: inline-block;
        flex-shrink: 0;
      }
      @keyframes marquee {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
      }
      #about {
        padding: 120px 0 100px;
        position: relative;
      }
      .head {
        display: grid;
        grid-template-columns: 240px 1fr;
        gap: 36px;
        margin-bottom: 56px;
      }
      .head h2 {
        font-size: clamp(2.3rem, 4.4vw, 4.4rem);
        line-height: 0.95;
        letter-spacing: -0.075em;
        margin: 0;
      }
      .intro {
        font-size: 18px;
        line-height: 1.6;
        color: var(--muted);
        margin: 24px 0 0;
        max-width: 760px;
      }
      .about {
        display: grid;
        grid-template-columns: 1.15fr 1fr;
        gap: 24px;
      }
      .statement {
        background: linear-gradient(135deg, var(--cobalt), #24235d);
        border-radius: 24px 0 24px 0;
        box-shadow: 12px 12px 0 var(--pink);
        padding: 44px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        min-height: 380px;
        color: #fff;
      }
      .statement p {
        font-size: clamp(1.6rem, 2.7vw, 2.75rem);
        line-height: 1.05;
        letter-spacing: -0.065em;
        margin: 0;
      }
      .statement em {
        color: var(--lime);
        font-style: italic;
      }
      .facts {
        background: #fffdf8;
        border: 1px solid var(--ink);
        display: grid;
        grid-template-columns: 1fr 1fr;
        min-height: 380px;
      }
      .fact {
        padding: 30px;
        border-right: 1px solid var(--ink);
        border-bottom: 1px solid var(--ink);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
      }
      .fact:nth-child(2n) {
        border-right: none;
      }
      .fact:nth-child(3),
      .fact:nth-child(4) {
        border-bottom: none;
      }
      .fact:nth-child(1) { background: var(--sky); }
      .fact:nth-child(2) { background: var(--violet); }
      .fact:nth-child(3) { background: var(--mint); }
      .fact:nth-child(4) { background: var(--pink); }
      .fact strong {
        font-size: clamp(2.4rem, 4vw, 3.8rem);
        letter-spacing: -0.06em;
        line-height: 1;
        font-family: "Bricolage Grotesque", sans-serif;
        color: #121428;
      }
      .fact p {
        margin: 12px 0 0;
        font-size: 13px;
        line-height: 1.4;
        color: #24273c;
        font-weight: 500;
      }
      .work {
        background: #17172a;
        background-image: radial-gradient(circle at 14% 18%, rgba(141, 220, 255, 0.28) 0 2px, transparent 2.5px),
          radial-gradient(circle at 82% 79%, rgba(216, 255, 69, 0.25) 0 2px, transparent 2.5px);
        background-size: 27px 27px, 37px 37px;
        padding: 120px 0;
        color: #fff;
      }
      .work .head h2 em {
        color: var(--lime);
      }
      .work .head .mono {
        color: var(--lime);
      }
      .card {
        margin-top: 36px;
        border: 1px solid rgba(255, 255, 255, 0.38);
        background: #202038;
        border-radius: 18px 2px 18px 2px;
        overflow: hidden;
        display: grid;
        grid-template-columns: 1fr 1.15fr;
        min-height: 380px;
        transition: transform 0.25s, box-shadow 0.25s;
      }
      .card:hover {
        transform: translate(8px, -4px) rotate(-0.25deg);
        box-shadow: -7px 7px 0 var(--pink);
      }
      .art {
        position: relative;
        min-height: 300px;
        overflow: hidden;
        border-right: 1px solid rgba(255, 255, 255, 0.2);
      }
      .tax {
        background: linear-gradient(135deg, var(--violet), var(--sky));
      }
      .tax .screen {
        position: absolute;
        width: 55%;
        height: 82%;
        bottom: -5%;
        left: 22%;
        border: 7px solid var(--cobalt);
        border-bottom: 0;
        border-radius: 25px 25px 0 0;
        background: #faf9ff;
        z-index: 1;
        box-shadow: 15px -9px 0 var(--pink);
      }
      .tax .screen:before {
        content: attr(data-art-headline);
        position: absolute;
        top: 23%;
        left: 12%;
        font-weight: 800;
        font-size: clamp(13px, 2vw, 24px);
        letter-spacing: -0.08em;
        color: var(--cobalt);
        width: 70%;
        line-height: 1.1;
      }
      .tax .pill {
        position: absolute;
        width: 105px;
        height: 38px;
        border-radius: 99px;
        background: var(--orange);
        left: 36%;
        bottom: 22%;
        z-index: 2;
      }
      .bhoomi {
        background: linear-gradient(135deg, var(--mint), var(--sky));
      }
      .bhoomi .window {
        position: absolute;
        inset: 13% 12%;
        border: 1px solid var(--cobalt);
        background: #f5eee3;
        padding: 12% 10%;
        z-index: 1;
      }
      .bhoomi .window:before {
        content: attr(data-art-headline);
        white-space: pre-wrap;
        color: var(--cobalt);
        font-size: clamp(14px, 2.3vw, 29px);
        font-weight: 800;
        letter-spacing: -0.08em;
        line-height: 0.9;
      }
      .bhoomi .leaf {
        position: absolute;
        height: 160px;
        width: 86px;
        border-radius: 100% 0 100% 0;
        background: var(--cobalt);
        right: 7%;
        bottom: -8%;
        transform: rotate(-25deg);
      }
      .core {
        background: linear-gradient(135deg, var(--pink), var(--orange));
      }
      .core .dash {
        position: absolute;
        inset: 16% 13%;
        background: var(--cobalt);
        transform: rotate(-2deg);
        z-index: 1;
        padding: 28px;
      }
      .core .dash:before {
        content: attr(data-art-headline);
        color: #fff;
        font-size: clamp(15px, 2.5vw, 28px);
        font-weight: 800;
        letter-spacing: -0.075em;
      }
      .bars {
        position: absolute;
        height: 35%;
        left: 12%;
        right: 12%;
        bottom: 12%;
        background: repeating-linear-gradient(90deg, var(--lime) 0 14%, transparent 14% 20%);
      }
      .art.custom {
        background: linear-gradient(135deg, var(--cobalt), var(--violet));
        display: grid;
        place-items: center;
        padding: 30px;
        color: #fff;
        text-align: center;
      }
      .copy {
        padding: 38px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
      }
      .tags {
        display: flex;
        flex-wrap: wrap;
        gap: 7px;
      }
      .tag {
        border: 1px solid rgba(246, 244, 238, 0.45);
        border-radius: 99px;
        padding: 6px 12px;
        font: 400 10px "DM Mono", monospace;
      }
      .tag:nth-child(2) {
        border-color: var(--sky);
        color: var(--sky);
      }
      .tag:nth-child(3) {
        border-color: var(--pink);
        color: var(--pink);
      }
      .copy h3 {
        font-size: clamp(1.75rem, 3vw, 3rem);
        line-height: 0.98;
        letter-spacing: -0.07em;
        margin: 20px 0 12px;
      }
      .copy p {
        color: #c1c1b9;
        line-height: 1.55;
        font-size: 14px;
        margin: 0;
      }
      .meta {
        display: flex;
        justify-content: space-between;
        gap: 10px;
        color: var(--lime);
        margin-top: 20px;
      }
      #experience {
        padding: 120px 0;
      }
      .exp-list {
        border-top: 1px solid var(--ink);
      }
      .exp {
        display: grid;
        grid-template-columns: 190px 1.25fr 1.25fr;
        gap: 25px;
        padding: 31px 0;
        border-bottom: 1px solid var(--line);
      }
      .exp h3 {
        margin: 0;
        font-size: 22px;
        letter-spacing: -0.055em;
      }
      .exp p {
        margin: 0;
        color: var(--muted);
        line-height: 1.5;
        font-size: 14px;
      }
      .role {
        color: var(--orange) !important;
        margin-bottom: 6px !important;
      }
      .toolkit-section {
        padding-bottom: 120px;
      }
      .tools {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        border-top: 1px solid var(--ink);
        border-left: 1px solid var(--ink);
      }
      .tool {
        background: #fffdf8;
        padding: 25px;
        min-height: 148px;
        border-right: 1px solid var(--ink);
        border-bottom: 1px solid var(--ink);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        transition: 0.2s;
      }
      .tool:nth-child(1) { border-top: 5px solid var(--cobalt); }
      .tool:nth-child(2) { border-top: 5px solid var(--orange); }
      .tool:nth-child(3) { border-top: 5px solid var(--violet); }
      .tool:nth-child(4) { border-top: 5px solid var(--mint); }
      .tool:hover {
        background: var(--sky);
        transform: rotate(-1deg) translateY(-5px);
      }
      .tool h3 {
        margin: 0;
        font-size: 18px;
        letter-spacing: -0.055em;
      }
      .tool p {
        color: #24273c;
        font-weight: 500;
        font-size: 12px;
        line-height: 1.5;
        margin: 8px 0 0;
      }
      .contact {
        padding: 115px 0 60px;
        background: linear-gradient(115deg, var(--orange) 0 42%, var(--pink) 42% 69%, var(--violet) 69%);
        position: relative;
        overflow: hidden;
      }
      .contact > .wrap {
        position: relative;
        z-index: 2;
      }
      .contact:before {
        content: "✳ ✦ ◼";
        position: absolute;
        right: 7vw;
        top: 23px;
        color: var(--cobalt);
        font-size: clamp(3rem, 8vw, 8rem);
        letter-spacing: 0.06em;
        transform: rotate(-13deg);
        opacity: 0.48;
      }
      .contact h2 {
        font-size: clamp(3.1rem, 7vw, 7rem);
        max-width: 1000px;
        line-height: 0.88;
        letter-spacing: -0.09em;
        margin: 0 0 42px;
      }
      .contact h2 em {
        color: var(--cobalt);
        text-decoration-color: var(--lime);
      }
      .contact-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px;
        margin-top: 40px;
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(12px);
        padding: 40px;
        border: 2px solid var(--ink);
        box-shadow: 10px 10px 0 var(--ink);
      }
      .contact-row {
        border-top: 1px solid rgba(17, 17, 15, 0.55);
        padding: 25px 0;
        display: flex;
        justify-content: space-between;
        gap: 30px;
        align-items: center;
      }
      .contact-row a {
        font-size: clamp(1.25rem, 2.7vw, 2.75rem);
        font-weight: 700;
        letter-spacing: -0.07em;
      }
      .contact-row a:hover {
        text-decoration: underline;
      }
      .form-group {
        margin-bottom: 18px;
      }
      .form-label {
        display: block;
        margin-bottom: 6px;
        font-weight: 600;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.05em;
      }
      .form-input,
      .form-textarea {
        width: 100%;
        padding: 12px 16px;
        background: #fff;
        border: 1.5px solid var(--ink);
        font-family: inherit;
        font-size: 15px;
        outline: none;
        transition: box-shadow 0.2s, border-color 0.2s;
      }
      .form-input:focus,
      .form-textarea:focus {
        border-color: var(--cobalt);
        box-shadow: 4px 4px 0 var(--cobalt);
      }
      .form-textarea {
        resize: vertical;
        min-height: 120px;
      }
      .alert {
        padding: 14px 18px;
        margin-bottom: 20px;
        border: 1px solid var(--ink);
        font-weight: 600;
        font-size: 14px;
      }
      .alert-success {
        background: var(--lime);
        color: var(--ink);
        box-shadow: 4px 4px 0 var(--cobalt);
      }
      .alert-danger {
        background: var(--orange);
        color: #fff;
        box-shadow: 4px 4px 0 var(--ink);
      }
      .footer {
        background: var(--cobalt);
        padding: 24px 0 30px;
        color: var(--lime);
      }
      .footer .wrap {
        display: flex;
        justify-content: space-between;
        align-items: center;
      }
      .footer a:hover {
        text-decoration: underline;
      }
      .reveal {
        opacity: 0;
        transform: translateY(18px);
        transition: 0.7s;
      }
      .reveal.show {
        opacity: 1;
        transform: none;
      }
      /* Prelude Loader */
      #loader {
        position: fixed;
        z-index: 9999;
        inset: 0;
        display: grid;
        place-items: center;
        overflow: hidden;
        background: #15151a;
        color: #fffdf4;
        transition: opacity 0.65s cubic-bezier(0.76, 0, 0.24, 1), visibility 0.65s;
      }
      #loader.is-gone {
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
      }
      .loader-grid {
        position: absolute;
        inset: -30%;
        opacity: 0.26;
        background-image: linear-gradient(#d8ff45 1px, transparent 1px),
          linear-gradient(90deg, #d8ff45 1px, transparent 1px);
        background-size: 42px 42px;
        transform: rotate(-12deg);
        animation: grid-drift 8s linear infinite;
      }
      .loader-copy {
        position: relative;
        z-index: 2;
        width: min(800px, calc(100% - 48px));
        text-align: center;
      }
      .loader-kicker {
        display: inline-flex;
        align-items: center;
        gap: 9px;
        color: var(--lime);
        margin-bottom: 17px;
      }
      .loader-kicker i {
        display: block;
        width: 10px;
        height: 10px;
        background: var(--orange);
        border-radius: 50%;
        animation: blink 0.75s steps(2, start) infinite;
      }
      .loader-word {
        margin: 0;
        font-size: clamp(4.4rem, 13vw, 10.4rem);
        font-weight: 800;
        line-height: 0.72;
        letter-spacing: -0.115em;
        text-transform: uppercase;
        transform: rotate(-3deg);
        text-shadow: 7px 7px 0 var(--orange), -3px -3px 0 var(--lime);
        animation: loader-bounce 1.1s cubic-bezier(0.16, 1, 0.3, 1) infinite alternate;
      }
      .loader-word em {
        font-family: "Playfair Display", serif;
        font-weight: 600;
        text-transform: none;
      }
      .loader-progress {
        width: min(390px, 76vw);
        height: 12px;
        margin: 46px auto 13px;
        border: 1px solid #fffdf4;
        padding: 2px;
        transform: rotate(1deg);
      }
      .loader-progress b {
        display: block;
        width: 2%;
        height: 100%;
        background: var(--lime);
        transition: width 0.18s ease;
        box-shadow: 5px 0 0 var(--orange);
      }
      .loader-status {
        display: flex;
        justify-content: space-between;
        color: #fffdf4;
      }
      .loader-stamp {
        position: absolute;
        z-index: 3;
        bottom: 8vh;
        right: 9vw;
        width: 128px;
        aspect-ratio: 1;
        display: grid;
        place-items: center;
        padding: 17px;
        border: 2px solid var(--orange);
        border-radius: 50%;
        color: var(--orange);
        background: #15151a;
        text-align: center;
        font: 500 10px/1.35 "DM Mono", monospace;
        text-transform: uppercase;
        transform: rotate(14deg);
        animation: stamp-spin 10s linear infinite;
      }
      .loader-stamp:before {
        content: "✳";
        position: absolute;
        font-size: 56px;
        color: var(--lime);
        opacity: 0.9;
      }
      .loader-stamp span {
        position: relative;
        z-index: 1;
        mix-blend-mode: screen;
      }
      .loader-shape {
        position: absolute;
        z-index: 1;
        border: 1px solid #fffdf4;
        animation: shape-orbit 5s ease-in-out infinite alternate;
      }
      .shape-a {
        width: 94px;
        height: 94px;
        top: 14%;
        left: 12%;
        background: var(--lime);
        border-radius: 48% 52% 58% 42%;
        transform: rotate(29deg);
      }
      .shape-b {
        width: 54px;
        height: 54px;
        bottom: 18%;
        left: 17%;
        background: var(--orange);
        border-radius: 50%;
        animation-delay: -1.5s;
      }
      .shape-c {
        width: 86px;
        height: 86px;
        top: 18%;
        right: 16%;
        background: transparent;
        transform: rotate(45deg);
        animation-delay: -3s;
      }
      .shape-d {
        width: 24px;
        height: 110px;
        right: 9%;
        bottom: 23%;
        background: var(--lime);
        transform: rotate(28deg);
        animation-delay: -2s;
      }
      .loader-ticket {
        position: absolute;
        z-index: 3;
        left: 8vw;
        bottom: 10vh;
        padding: 11px 14px;
        border: 1px solid #fffdf4;
        background: #15151a;
        color: #fffdf4;
        transform: rotate(-7deg);
      }
      @keyframes grid-drift {
        to { transform: rotate(-12deg) translate(42px, 42px); }
      }
      @keyframes loader-bounce {
        to { transform: rotate(2deg) scale(1.025); }
      }
      @keyframes blink {
        to { opacity: 0.18; }
      }
      @keyframes stamp-spin {
        to { transform: rotate(374deg); }
      }
      @keyframes shape-orbit {
        to { translate: 22px -31px; rotate: 80deg; border-radius: 18%; }
      }
      @keyframes blob-hop {
        50% {
          border-radius: 31% 69% 38% 62%;
          transform: translate(38px, 31px) rotate(34deg);
          background: var(--sky);
        }
        100% {
          transform: translate(-13px, 51px) rotate(-16deg);
        }
      }
      @media (max-width: 800px) {
        .wrap { width: min(100% - 36px, 1240px); }
        .nav { height: 70px; }
        .nav:after { top: 69px; }
        .links { display: none; }
        .hero { grid-template-columns: 1fr; padding: 64px 0 48px; min-height: 0; }
        .hero:before { right: 5%; top: 35px; width: 76px; height: 76px; }
        .hero:after { bottom: 15px; left: 0; }
        .hero-side { justify-content: center; padding-top: 10px; }
        .orbit { height: 270px; width: 270px; }
        .hero-copy { font-size: 16px; }
        .head, .about { grid-template-columns: 1fr; }
        .head { gap: 18px; }
        .head h2 { font-size: 3rem; }
        .statement { min-height: 290px; padding: 28px; box-shadow: 8px 8px 0 var(--pink); }
        .facts { min-height: 290px; }
        .fact { padding: 19px; }
        .fact strong { font-size: 26px; }
        .card { grid-template-columns: 1fr; }
        .art { min-height: 220px; }
        .copy { padding: 27px; }
        .exp { grid-template-columns: 1fr; gap: 10px; padding: 25px 0; }
        .tools { grid-template-columns: 1fr 1fr; }
        .contact { padding-top: 78px; }
        .contact:before { right: 3vw; top: 8px; opacity: 0.6; }
        .contact-grid { grid-template-columns: 1fr; padding: 25px; }
        .contact-row { align-items: flex-start; flex-direction: column; gap: 10px; }
        .footer .wrap { gap: 15px; flex-direction: column; }
      }
      @media (max-width: 420px) {
        h1 { font-size: 3.55rem; }
        .actions { display: grid; grid-template-columns: 1fr; }
        .button { width: 100%; }
        .tools { grid-template-columns: 1fr; }
        .note { display: none; }
        .mono { font-size: 10px; }
      }
      @media (prefers-reduced-motion: reduce) {
        *, *:before, *:after {
          animation-duration: 0.001ms !important;
          transition-duration: 0.001ms !important;
          scroll-behavior: auto !important;
        }
      }
    </style>
    @stack('styles')
  </head>
  <body>
    <div id="loader" role="status" aria-live="polite" aria-label="Loading Divyansh's portfolio">
      <div class="loader-grid"></div>
      <i class="loader-shape shape-a"></i>
      <i class="loader-shape shape-b"></i>
      <i class="loader-shape shape-c"></i>
      <i class="loader-shape shape-d"></i>
      <div class="loader-ticket mono">curiosity.exe<br>is running</div>
      <div class="loader-stamp"><span>Too weird<br>to be<br>boring</span></div>
      <div class="loader-copy">
        <div class="loader-kicker mono"><i></i> Calibrating ideas</div>
        <p class="loader-word">Hold<br><em>the</em><br>chaos.</p>
        <div class="loader-progress"><b id="loader-bar"></b></div>
        <div class="loader-status mono"><span id="loader-message">Collecting pixels</span><span id="loader-count">02%</span></div>
      </div>
    </div>

    <header class="wrap nav">
      <a class="brand" href="{{ route('portfolio.home') }}#top"><i></i>divyansh.</a>
      <nav class="links mono">
        <a href="#work">Selected work</a>
        <a href="#about">About</a>
        <a href="#experience">Experience</a>
        <a href="#toolkit">Toolkit</a>
        <a href="#say-hello">Say Hello</a>
      </nav>
      <a class="cta" href="#say-hello">Let's talk ↗</a>
    </header>

    @yield('content')

    <footer class="footer">
      <div class="wrap">
        <span class="mono">{{ $settings['footer_copyright'] ?? '© 2026 Divyansh Chawla' }}</span>
        <span class="mono">{{ $settings['footer_tagline'] ?? 'Designed & built with intent' }}</span>
        <a class="mono" href="#say-hello">Send a message ↗</a>
        <a class="mono" href="{{ route('admin.login') }}" style="opacity: 0.7; font-size: 10px;">Admin Panel ↗</a>
      </div>
    </footer>

    <script>
      const o = new IntersectionObserver(
        (e) =>
          e.forEach((x) => {
            if (x.isIntersecting) {
              x.target.classList.add("show");
              o.unobserve(x.target);
            }
          }),
        { threshold: 0.12 },
      );
      document.querySelectorAll(".reveal").forEach((x) => o.observe(x));

      const loader = document.querySelector("#loader");
      const loaderBar = document.querySelector("#loader-bar");
      const loaderCount = document.querySelector("#loader-count");
      const loaderMessage = document.querySelector("#loader-message");
      const loaderMessages = ["Collecting pixels", "Untangling ideas", "Adding unnecessary sparkle", "Making it strange", "Ready to make noise"];
      const reduceMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
      let loaderProgress = 2;
      const paintLoader = () => {
        if (!loaderBar || !loaderCount || !loaderMessage) return;
        loaderBar.style.width = `${loaderProgress}%`;
        loaderCount.textContent = `${String(Math.round(loaderProgress)).padStart(2, "0")}%`;
        loaderMessage.textContent = loaderMessages[Math.min(loaderMessages.length - 1, Math.floor(loaderProgress / 22))];
      };
      const loaderTimer = setInterval(() => {
        loaderProgress = Math.min(96, loaderProgress + Math.max(3, Math.random() * 15));
        paintLoader();
      }, 170);
      const finishLoader = () => {
        clearInterval(loaderTimer);
        loaderProgress = 100;
        paintLoader();
        if (loader) {
          setTimeout(() => loader.classList.add("is-gone"), reduceMotion ? 0 : 240);
        }
      };
      window.addEventListener("load", () => setTimeout(finishLoader, reduceMotion ? 0 : 1450), { once: true });
    </script>
    @stack('scripts')
  </body>
</html>

