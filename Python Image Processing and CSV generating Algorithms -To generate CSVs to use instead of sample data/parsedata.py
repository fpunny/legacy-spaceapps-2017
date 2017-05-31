meta = open('metadata.txt', 'r')
csv = open('db.csv', 'w+')
data = meta.readlines()
roll_nums = []
img_nums = []
img_names = []
metadata = []
dates = []
stations = []

jan = range(1,32)
feb = range(32,60)
mar = range(60, 91)
apr = range(91, 121)
may = range(121, 152)
jun = range(152, 182)
jul = range(182, 213)
aug = range(213, 244)
sept = range(244, 274)
octo = range(274, 305)
nov = range(305, 335)
dec = range(335,366)

months = [jan, feb, mar, apr, may, jun, jul, aug, sept, octo, nov, dec]

for line in data:
    line = line.replace(',', '')
    line = line.strip('\n')
    line = line.strip()
    parsed = line.split()
    roll_nums.append(parsed[0])
    img_nums.append(parsed[1])
    img_names.append(parsed[2])
    metadata.append(parsed[3])

for line in metadata:
    date = ''
    day = int(line[:3])
    if(int(day) >= 272):
        date += "1962"
    else:
        date += "1963"
    date += "-"
    for month in months:
        if(day in month):
            mo = str(months.index(month) + 1)
            if(not(month is jan)):
                dom = str(month.start - day)
            else:
                dom = str(day)
    if(len(mo) < 2):
        date += "0" + mo
    else:
        date += mo
    date += '-'
    if(len(dom) < 2):
        date += '0' + dom
    else:
        date += dom
    date += ' '
    hour = line[3:5]
    minute = line[5:7]
    second = line[7:9]
    station = line[9]
    date += hour + ":" + minute + ":" + second + "+00"
    dates.append(date)
    stations.append(station)

for x in range(0, len(roll_nums)):
    csv.write("%s,%s,%s,%s,%s,%s,%s\n" %(roll_nums[x], img_nums[x], '1', dates[x], stations[x], img_names[x], 't'))

meta.close()
csv.close()
