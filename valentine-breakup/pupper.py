import math

IS_DEV = False
cases = []
offsetOrdValue = -96


def is_prime(n):
    if n % 2 == 0 and n > 2: 
        return False
    return all(n % i for i in range(3, int(math.sqrt(n)) + 1, 2))


class Case(object):

    def __init__(self):
        self.numLetters = 0
        self.text = ""

    def debug(self):
        output = "letters ("+self.numLetters+"): " + self.text
        output += "\n wordValue is: " + str(self.wordVal())
        return output

    def wordVal(self):
        output = 0
        letters = list(self.text)
        for l in letters:
            output += (offsetOrdValue+ord(l))

        return output

    



if( IS_DEV ):
    with file("test.txt") as f:
        inputText = f.read()
        inputText = inputText.split("\n")
        
        #print inputText
        numCases = int(inputText[0])
        for i in range(0, numCases):
            case = Case()
            case.numLetters = inputText[i * 2 + 1]
            case.text = inputText[i * 2 + 2]
            cases.append(case)
else:
    inputText = raw_input()

    numCases = int(inputText)
    for i in range(0, numCases):
        case = Case()
        case.numLetters = raw_input()
        case.text = raw_input()
        cases.append(case)


#print "---cases---"
#for case in cases:
#    print( case.debug() )
#print "---------\n\n"


for case in cases:
    wordVal = case.wordVal()
    if is_prime(wordVal):
        print("seen")
    else:
        print("unseen")