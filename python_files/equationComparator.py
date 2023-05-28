import sys,re,warnings
from sympy import simplify,expand
from sympy.parsing.latex import parse_latex

warnings.filterwarnings("ignore", category=DeprecationWarning)

# Get a latex_string arguments from the command line
latex_string1 = sys.argv[1]
latex_string2 = sys.argv[2]

# Parse latex expression after last equals
match1 = re.search(r'=([^=]*)$', latex_string1)
match2 = re.search(r'=([^=]*)$', latex_string2)
if match1:
    latex_string1 = match1.group(1).strip()
if match2:
    latex_string2 = match2.group(1).strip()

# Parse the latex string into sympy equations
parsed_equation1 = parse_latex(latex_string1)
parsed_equation2 = parse_latex(latex_string2)

# Simplify the equations
simplified_equation1 = simplify(parsed_equation1)
simplified_equation2 = simplify(parsed_equation2)

# Expand the equations
simplified_equation1 = expand(simplified_equation1)
simplified_equation2 = expand(simplified_equation2)

# Evaluate fractions to float numbers
simplified_equation1 = simplified_equation1.evalf()
simplified_equation2 = simplified_equation2.evalf()

for term in simplified_equation1.expr_free_symbols:
    if term.is_Float:
        converted_coefficient = round(term, 4)
        simplified_equation1 = simplified_equation1.subs(term, converted_coefficient)

for term in simplified_equation2.expr_free_symbols:
    if term.is_Float:
        converted_coefficient = round(term, 4)
        simplified_equation2 = simplified_equation2.subs(term, converted_coefficient)

eq1_string = str(simplified_equation1)
eq2_string =str(simplified_equation2)

# Custom equation comparator
# Takes into account possible rounding (+0.0001)
equations_equality = 1
if len(eq1_string) == len(eq2_string):
    for i in range(len(eq1_string)):
        char1 = eq1_string[i]
        char2 = eq2_string[i]

        if char1 != char2:
            # Check if the character is at the 4th place after the dot symbol
            if i - 4 >= 0 and eq1_string[i - 4] == '.':
                # Check if all symbols between the dot symbol and the 4th number are numbers
                if eq1_string[i - 3:i].isdigit() and int(char2) >= 5:
                    # Calculate the difference between the characters
                    difference = int(char2) - int(char1)
                    if difference != 1:
                        equations_equality = 0
                        break
                else:
                    equations_equality = 0
                    break
            else:
                equations_equality = 0
                break

if equations_equality:
    print("true")
else:
    print("false")
