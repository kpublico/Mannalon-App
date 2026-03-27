<?php
// Simple helper to create a test PDF
$content = <<<'PDF'
%PDF-1.4
1 0 obj
<<
/Type /Catalog
/Pages 2 0 R
>>
endobj
2 0 obj
<<
/Type /Pages
/Kids [3 0 R]
/Count 1
>>
endobj
3 0 obj
<<
/Type /Page
/Parent 2 0 R
/MediaBox [0 0 612 792]
/Contents 4 0 R
/Resources <<
/Font <<
/F1 5 0 R
>>
>>
>>
endobj
4 0 obj
<<
/Length 200
>>
stream
BT
/F1 24 Tf
50 750 Td
(Test Farming Guide PDF) Tj
0 -30 Td
/F1 12 Tf
(This is a test PDF document) Tj
0 -20 Td
(for the Mannalon Farming Guides System) Tj
ET
endstream
endobj
5 0 obj
<<
/Type /Font
/Subtype /Type1
/BaseFont /Helvetica
>>
endobj
xref
0 6
0000000000 65535 f 
0000000009 00000 n 
0000000058 00000 n 
0000000115 00000 n 
0000000260 00000 n 
0000000507 00000 n 
trailer
<<
/Size 6
/Root 1 0 R
>>
startxref
594
%%EOF
PDF;

$targetPath = __DIR__ . '/storage/app/public/farm_guides/test_guide.pdf';
file_put_contents($targetPath, $content);
echo "Test PDF created at: $targetPath\n";
?>
