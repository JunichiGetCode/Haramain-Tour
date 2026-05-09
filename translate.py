import re
import os

files = ['resources/views/panduan.blade.php', 'resources/views/doa.blade.php', 'resources/views/kamus.blade.php', 'resources/views/faq.blade.php']

for filepath in files:
    if not os.path.exists(filepath): continue
    with open(filepath, 'r', encoding='utf-8') as f:
        content = f.read()

    def replacer(match):
        text = match.group(2).strip()
        if not text: return match.group(0)
        
        # Skip if it has blade syntax
        if '{' in text or '}' in text or '@' in text or '$' in text:
            return match.group(0)
            
        # Skip if only numbers or special chars
        if not re.search('[a-zA-Z]', text):
            return match.group(0)

        # Skip if it's already translated
        if '__(' in text:
            return match.group(0)

        # Skip latin and arabic texts if possible
        if 'Allahumma' in text or 'Bismillahi' in text or 'Subhanallah' in text or 'Rabbanaa' in text:
            return match.group(0)
            
        # Skip Arabic characters block (simple heuristic)
        if re.search(r'[\u0600-\u06FF]', text):
            return match.group(0)

        if len(text) > 1:
            escaped_text = text.replace("'", "\\'")
            new_text = match.group(0).replace(text, "{{ __('" + escaped_text + "') }}")
            return new_text
        return match.group(0)

    for tag in ['h1', 'h2', 'h3', 'h4', 'h5', 'p', 'span', 'li', 'button', 'a', 'div', 'strong']:
        pattern = r'(<' + tag + r'[^>]*>)([^<]+?)(</' + tag + r'>)'
        content = re.sub(pattern, replacer, content)

    with open(filepath, 'w', encoding='utf-8') as f:
        f.write(content)

print("Done applying translations via script.")
