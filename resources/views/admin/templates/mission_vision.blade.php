<div class="theme-inner-banner mb-3">
    <div class="overlay">
        <div class="container">
            <h2>Vision &nbsp;&nbsp;|&nbsp;&nbsp; Mission &nbsp;&nbsp;|&nbsp;&nbsp; History</h2>
        </div>
    </div>
</div>



<?php

$content = $page->getTranslation('post_content', $lang);
// Regular expression pattern to match a simple HTML table
$tablePattern = '/<tr>\s*<td[^>]*>\s*<h3[^>]*>(.*?)<\/h3>\s*<\/td>\s*<td[^>]*>\s*(.*?)\s*<\/td>\s*<\/tr>/si';
// Check if the content contains a table
if (preg_match_all($tablePattern, $content, $matches, PREG_SET_ORDER)) {
    // Loop through the matched table rows
    foreach ($matches as $match) {
       
        // Extract data from the match
        $title = $match[1];
        $data = $match[2];

        // Output the row inside the desired div structure
        echo '<div class="callout-banner no-bg">';
        echo '<div class="container clearfix">';
        echo '<h3 class="title">' . $title . '</h3>';
        echo '<p>' . $data . '</p>';
        echo '</div>';
        echo '</div>';
  
    
    }
    // $remainingContent = preg_replace($tablePattern, '', $content);

    // echo $remainingContent;
}
 

?>