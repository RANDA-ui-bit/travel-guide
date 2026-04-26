<?php
$pageTitle = 'Tours - Travel & Tourism Guide';
require_once __DIR__ . '/partials/header.php';
?>

<section class="section">
  <div class="container">
    <h1 style="margin-top:0;">Tours</h1>
    <p class="help">Example tour packages (table #1).</p>

    <table class="table" aria-label="Tour packages">
      <thead>
        <tr>
          <th>Tour</th>
          <th>Duration</th>
          <th>Style</th>
          <th>Starting Price</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>City Highlights</td>
          <td>2 Days</td>
          <td>Culture</td>
          <td style="color: var(--accent2); font-weight: 800;">$199</td>
        </tr>
        <tr>
          <td>Food & Markets</td>
          <td>1 Day</td>
          <td>Food</td>
          <td style="color: var(--accent2); font-weight: 800;">$89</td>
        </tr>
        <tr>
          <td>Nature Escape</td>
          <td>3 Days</td>
          <td>Adventure</td>
          <td style="color: var(--accent2); font-weight: 800;">$299</td>
        </tr>
        <tr>
          <td>Historical Trail</td>
          <td>2 Days</td>
          <td>History</td>
          <td style="color: var(--accent2); font-weight: 800;">$179</td>
        </tr>
      </tbody>
    </table>

    <div style="margin-top:16px;">
      <h2>What’s included</h2>
      <ul>
        <li>Local guide</li>
        <li>Transportation (where applicable)</li>
        <li>Recommended itinerary PDF</li>
      </ul>

      <h2>Booking link</h2>
      <p class="help">External example: <a href="https://www.lonelyplanet.com/" target="_blank" rel="noreferrer">Lonely Planet</a></p>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
