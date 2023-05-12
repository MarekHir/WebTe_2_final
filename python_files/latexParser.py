import re
import os
import sys
from pylatexenc.latex2text import LatexNodes2Text

def read_file(path):
    with open(path, 'r', encoding='utf-8') as file:
        data = file.read()
    return data

# Get the path argument from the command line
path = sys.argv[1]

# Call the function with the provided path argument
data = read_file(path)

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
        picture_name = os.path.basename(graphics[0])
        parsed_task['picture_name'] = picture_name

    # Assign whole task description (text + function)
    if "begin{equation*}" in section and listOfStrings[2] != "< g r a p h i c s >":
        parsed_task['task'] = listOfStrings[1] + ' ' + listOfStrings[2]
    else:
        parsed_task['task'] = listOfStrings[1]

    parsed_task['solution'] = listOfStrings[3]

    parsed_tasks.append(parsed_task)

print(parsed_tasks)
