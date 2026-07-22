import os

files_to_fix = [
    'why-us.php',
    'careers.php',
    'corporate.php',
    'best-time-to-visit.php',
    'travel-confidence.php',
    'travel-insurance.php',
    'best-price-guarantee.php',
    'booking-terms.php',
    'privacy-policy.php'
]

base_dir = 'e:/xampp/htdocs/attwood'
insert_string = '\n<link rel="stylesheet" href="css/attwood-brand.css?v=<?= time() ?>">\n'

for f in files_to_fix:
    path = os.path.join(base_dir, f)
    if os.path.exists(path):
        with open(path, 'r', encoding='utf-8') as file:
            content = file.read()
            
        if 'attwood-brand.css' not in content:
            # find </head> and insert before it
            if '</head>' in content:
                content = content.replace('</head>', insert_string + '</head>')
                with open(path, 'w', encoding='utf-8') as file:
                    file.write(content)
                print(f"Fixed {f}")
            else:
                print(f"Could not find </head> in {f}")
        else:
            print(f"Already fixed {f}")
    else:
        print(f"File not found: {f}")
