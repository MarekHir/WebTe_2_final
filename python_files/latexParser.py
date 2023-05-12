import re
import os
import sys
# import subprocess
from pylatexenc.latex2text import LatexNodes2Text

def read_file(path):
    with open(path, 'r', encoding='utf-8') as file:
        data = file.read()
    return data

# Get the path argument from the command line
path = sys.argv[1]

# Call the function with the provided path argument
data = read_file(path)

# ('C:/Users/42191/Desktop/zaverecne_zadanie/odozva01pr.tex', 'r', encoding='utf-8')

parsed_tasks = []

sections = data.split('\\section*{')[1:]

for section in sections:
    # Dictionary
    parsed_task = {}

    # Convert latex to text
    latex_text = LatexNodes2Text().latex_to_text(section)

    # Split && strip lines
    listOfStrings = latex_text.split('\n')
    listOfStrings = [s.strip() for s in listOfStrings if s.strip()]

    parsed_task['file_name'] = os.path.basename(path)
    parsed_task['section_title'] = listOfStrings[0]

    # Parse the picture PATH
    if "\includegraphics" in section:
        graphics = re.findall(r'\\includegraphics{(.*?)}', section)
        parsed_task['picture_path'] = graphics[0]

    # Assign whole task description (text + function)
    if "begin{equation*}" in section:
        parsed_task['task'] = listOfStrings[1] + ' ' + listOfStrings[2]
    else:
        parsed_task['task'] = listOfStrings[1]

    parsed_task['solution'] = listOfStrings[3]

    parsed_tasks.append(parsed_task)

print(parsed_tasks)

# for task in parsed_tasks:
#     print(task)

# Run the PHP script and pass the output of the Python script to it
# process = subprocess.Popen(['php', 'test.php'], stdin=subprocess.PIPE, stdout=subprocess.PIPE)
# output, error = process.communicate(b'Hello from Python')
