import sys
from sympy import simplify
from sympy.parsing.latex import parse_latex

# Get a latex_string arguments from the command line
equation = sys.argv[1]
latex_string2 = sys.argv[2]

# Parse the latex_string into a sympy equations
equation2 = parse_latex(latex_string2)

# Simplify the equations
simplified_equation1 = simplify(equation)
simplified_equation2 = simplify(equation2)

if simplified_equation1 == simplified_equation2:
    print("true")
else:
    print("false")
