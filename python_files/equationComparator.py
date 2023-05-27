import sys
from sympy import Eq,simplify
from sympy.parsing.latex import parse_latex

# Get a latex_string arguments from the command line
latex_string1 = sys.argv[1]
latex_string2 = sys.argv[2]

# Parse the latex_string into a sympy equations
equation1 = parse_latex(latex_string1)
equation2 = parse_latex(latex_string2)

# Simplify the equations
simplified_equation1 = simplify(equation1)
simplified_equation2 = simplify(equation2)

# If DB stores Eq but user input is NOT
if isinstance(simplified_equation1,Eq):
    if not isinstance(simplified_equation2,Eq):
        simplified_equation1 = simplified_equation1.args[1]

# If DB NOT stores Eq but user input IS
if not isinstance(simplified_equation1,Eq):
    if isinstance(simplified_equation2,Eq):
        simplified_equation2 = simplified_equation2.args[1]

if simplified_equation1.equals(simplified_equation2):
    print("true")
else:
    print("false")
