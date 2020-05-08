# A) Programming Test
## Requirements
1. API shall accept both number of people and number of cards as input.
2. API shall return "Input value does not exist or value is invalid" if input is invalid.
3. API shall accept input > 0, any other numbers are considered invalid.
4. API shall accept and return in JSON format.
5. API shall generate random cards to each person.
6. API shall represent a card's suit with the letter:
  - Spade = S
  - Heart = H
  - Diamond = D
  - Club = C
7. API shall represent a card's rank with the letter:
  - 1 = A
  - 2-9 = As it is
  - 10 = X
  - 11 = J
  - 12 = Q
  - 13 = K
8. API shall return the each card in the format `<suit>-<rank>`, e.g. `S-A`, `H-X`

### Ambiguity and Assumptions
1. Program Input: It does not matter how cards are given if recompile of program arguments, parameter, keyboard input and so on are not necessary.
  - Assumption: No specific requirements to follow specific algorithm for cards distribution.
2. Program Output: The card distributed to the x person on the x row will be separated (comma).
  - Assumption: Each person can get y number of cards, and system should output the first row of comma-separated cards to the first person, and second row of comma-separated cards for the second person.
