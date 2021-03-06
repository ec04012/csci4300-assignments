with open("list.txt", "r") as f:
    lines = f.read()
    lines = lines.split("\n\n")
    for i in range(0,len(lines)):
        lines[i] = lines[i].split("\n")
    for i in range(0,len(lines)):
        if len(lines[i])==4:  
            lines[i][0] = "<th class=\"left\">" + lines[i][0] + "</th>"
            for j in range(1,4):
                lines[i][j] = "<td>" + lines[i][j] + "</td>"
            lines[i].insert(0, "<tr>")
            lines[i].append("</tr>")
        else:            
            for j in range(0,3):
                lines[i][j] = "<td>" + lines[i][j] + "</td>"
            lines[i].insert(0, "<th class=\"left\"></th>")
            lines[i].insert(0, "<tr>")
            lines[i].append("</tr>")
    for subList in lines:
        for line in subList:
            print(line)
    