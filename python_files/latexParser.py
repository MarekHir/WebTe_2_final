import re
import os
import sys
import json
from pylatexenc.latex2text import LatexNodes2Text
from sympy import Equality
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
    latex_equation = latex_equation.replace('y(t)=', '')
    solution_equation = parse_latex(latex_equation)
    lhs = None
    if isinstance(solution_equation, Equality):
        lhs = solution_equation.lhs

    # Split && strip lines
    listOfStrings = latex_text.split('\n')
    listOfStrings = [s.strip() for s in listOfStrings if s.strip()]

    latex_task = ''
    lines_of_task = re.findall(r'\\begin{task}(.*?)\\end{task}', section, re.DOTALL)[0].strip().split('\n')
    equation_started = False
    for line in lines_of_task:
        line = line.strip()
        if('\includegraphics' in line or len(line) == 0):
            continue
        if('{equation*}' in line):
            equation_started = not equation_started
            latex_task +=  f'{line}\\\\\n'
        elif(equation_started):
            latex_task +=  f'{line}\\\\\n'
        else:
            latex_task += f'\\text{{{line.strip()}}}\\\\\n'

    parsed_task['task'] = latex_task

    # odozva02pr.tex style task (Differential equations)
    if len(listOfStrings) == 6:
        listOfStrings[2] = listOfStrings[2].replace("'", '′')
        listOfStrings[2] = listOfStrings[2].replace('^','')
        listOfStrings[2] = listOfStrings[2].replace('”', "′′")
        listOfStrings[4] = listOfStrings[4].replace("'", '′')
        listOfStrings[4] = listOfStrings[4].replace('^', '')
        listOfStrings[4] = listOfStrings[4].replace('”', "′′")
    parsed_task['file_name'] = os.path.basename(path)
    parsed_task['section_title'] = listOfStrings[0]

    # Extract && parse picture name from path (NULLABLE)
    pattern = r"\\includegraphics{(.*?)}"
    matches = re.findall(pattern, section, re.DOTALL)
    if matches:
        parsed_task['picture_name'] = os.path.basename(matches[0])

    # Assign whole task description (text + equation)
#     if task_equation is None:
#         parsed_task['task'] = listOfStrings[1]
#     elif len(listOfStrings) == 6:
#         parsed_task['task'] = listOfStrings[1] + ' ' + listOfStrings[2] + ' ' + listOfStrings[3] + ' ' + listOfStrings[4]
#     else:
#         parsed_task['task'] = listOfStrings[1] + ' ' + str(task_equation)

    # Assign solution if its equation only left side
    if lhs is not None:
        parsed_task['solution'] = str(lhs)
    else:
        parsed_task['solution'] = str(solution_equation)

    parsed_tasks.append(parsed_task)

print(json.dumps(parsed_tasks))
