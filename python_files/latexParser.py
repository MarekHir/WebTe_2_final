import re
import os
import sys
from pylatexenc.latex2text import LatexNodes2Text
from sympy.parsing.latex import parse_latex

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

    # Extract && parse task equation (NULLABLE)
    pattern = r"\\begin{task}(.*?)\\begin{equation\*}(.*?)\\end{equation\*}(.*?)\\end{task}"
    matches = re.findall(pattern, section, re.DOTALL)
    task_equation = None
    if matches:
        latex_equation = matches[0][1].strip()
        task_equation = parse_latex(latex_equation)

    # Extract && parse solution equation
    pattern = r"\\begin{solution}(.*?)\\begin{equation\*}(.*?)\\end{equation\*}(.*?)\\end{solution}"
    matches = re.findall(pattern, section, re.DOTALL)
    latex_equation = matches[0][1].strip()
    solution_equation = parse_latex(latex_equation)

    # Split && strip lines
    listOfStrings = latex_text.split('\n')
    listOfStrings = [s.strip() for s in listOfStrings if s.strip()]

    parsed_task['file_name'] = os.path.basename(path)
    parsed_task['section_title'] = listOfStrings[0]

    # Extract && parse picture name from path (NULLABLE)
    pattern = r"\\includegraphics{(.*?)}"
    matches = re.findall(pattern, section, re.DOTALL)
    if matches:
        picture_name = os.path.basename(matches[0])
        parsed_task['picture_name'] = picture_name

    # Assign whole task description (text + equation)
    if task_equation is None:
        parsed_task['task'] = listOfStrings[1]
    else:
        parsed_task['task'] = listOfStrings[1] + ' ' + str(task_equation.args[1])

    parsed_task['solution'] = solution_equation.args[1]

    parsed_tasks.append(parsed_task)

print(parsed_tasks)
