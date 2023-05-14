import sys
from sympy import simplify
from sympy.parsing.latex import parse_latex

# Get a latex_string arguments from the command line
latex_string = r"{}".format(sys.argv[1])
latex_string2 = r"{}".format(sys.argv[2])

# Parse the latex_string into a sympy equations
equation = parse_latex(latex_string)
equation2 = parse_latex(latex_string2)

# Simplify the equations
simplified_equation1 = simplify(equation)
simplified_equation2 = simplify(equation2)

if simplified_equation1 == simplified_equation2:
    print("false")
else:
    print("true")
