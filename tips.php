<?php
$pageTitle = 'Travel Tips - Travel & Tourism Guide';
$internalCss = "
  #tipsHeader {\n    color: var(--purple);\n    margin-top: 0;\n  }\n
  .tip-card {\n    border: 1px solid rgba(255, 183, 3, 0.25);\n    background: rgba(255, 183, 3, 0.08);\n    border-radius: 16px;\n    padding: 12px 14px;\n    margin-bottom: 14px;\n  }\n";

require_once __DIR__ . '/partials/header.php';
?>

<section class="section">
  <div class="container">
    <h1 id="tipsHeader">Travel Tips</h1>

    <div class="tip-card">
      <strong style="color: var(--accent);">Quick idea:</strong> Keep copies of important documents (passport, tickets) in cloud storage.
    </div>

    <div class="clearfix">
      <img class="float-left" src="https://picsum.photos/id/1037/900/600" alt="Packing" />
      <h2>Packing checklist (unordered list)</h2>
      <ul>
        <li>Universal adapter</li>
        <li>Comfortable shoes</li>
        <li>Refillable water bottle</li>
        <li>Basic medicine kit</li>
      </ul>

      <h2>How to plan (ordered list)</h2>
      <ol>
        <li>Pick dates and set a budget</li>
        <li>Choose 2-3 main locations</li>
        <li>Book accommodation</li>
        <li>Build a day-by-day itinerary</li>
      </ol>
    </div>

    <h2>Embedded media</h2>
    <p class="help">Video + audio requirement.</p>

    <div class="card" style="padding: 12px;">
      <div style="aspect-ratio: 16 / 9; width: 100%;">
        <iframe
          width="100%"
          height="100%"
          src="https://www.youtube.com/embed/u5UIU55Ctoo"
          title="Travel video"
          frameborder="0"
          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
          allowfullscreen
          style="border-radius: 14px; border: 1px solid rgba(184, 192, 255, 0.15);"
        ></iframe>
      </div>

      <div style="margin-top: 10px;">
        <audio controls style="width: 100%;">
          <source src="https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3" type="audio/mpeg" />
        </audio>
      </div>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
