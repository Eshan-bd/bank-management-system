import os, re

with open(os.getcwd()+'/tests/test.txt', 'r') as f:
    code = f.read()

print(code)

files = os.listdir('./tests/Unit')

for file in files:
    with open(os.getcwd()+'/tests/Unit/'+file, 'w') as f:
        wCode = re.sub(r"\bclass Test\b","class "+file[0:-4], code)
        f.write(wCode)
        print(file)