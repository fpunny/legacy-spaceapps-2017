from PIL import Image
import glob
CHECK_COLUMN = 200
MIN_WHITE = 127
COLUMN_DELTA = 5
ROW_DELTA = 30
DOT_SIZE = 1875
EDGE_THRESHOLD = 18

def find_edge(img):
    num_needed = (EDGE_THRESHOLD * img.width)//100
    current_row = img.height -1
    found = False
    y = img.height - 1
    while(not(found) and y >= 0):
        num_white = 0
        for x in range(0, img.width):
            if(is_white(img.getpixel((x, y)))):
                num_white += 1
            if(num_white >= num_needed):
                current_row = y
                found = True
        y -= 1
    return current_row

# old algorithm for edge detection
##def find_edge(img):
    ### returns co-ordinates of the edge of the ionogram
    ### should also confirm edge by checking above and below (w/b), 10px width
    ##white_px = False
    ##current_row = 0
    ##for i in range(img.height - 1, 0, -1):
        ##if(img.getpixel((CHECK_COLUMN, i)) >= MIN_WHITE):
            ##if(test_edge(i - ROW_DELTA, is_white) and
               ##test_edge(i + ROW_DELTA, is_black) ):
                ##current_row = i
                ##break
    ##return current_row

def test_edge(row, test_pixel):
    # tests the row for specified value (either white or black)
    result = True
    for i in range(CHECK_COLUMN - COLUMN_DELTA, CHECK_COLUMN + COLUMN_DELTA):
        if(not(test_pixel(img.getpixel((i, row))))):
            result = False
    return result

def is_white(value):
    return value > MIN_WHITE

def is_black(value):
    return value <= MIN_WHITE

def find_dots(img):
    dots = []
    top = find_edge(img) + ROW_DELTA
    for row in range(top, img.height - 1):
        dots += find_dots_in_row(row, img)
    return dots

def find_dots_in_row(row, img):
    # returns a list of dot centres
    result = []
    for x in range(0, img.width - 1):
        if(is_white(img.getpixel((x, row)))):
            dot_center = find_a_dot(img, x, row)
            if(not(dot_center == (0,0))):
                result.append(dot_center)
    return result
            
def find_a_dot(img, x, row):
    # first find white area, then average the white area to find the center if it is not noise
    look_at = [(x, row)]
    dot_area = find_white_area(img, look_at, [])
    if(not(len(dot_area) <= DOT_SIZE)):
        total_x = 0
        total_y = 0
        for px in dot_area:
            total_x += px[0]
            total_y += px[1]
        avg_x = total_x // len(dot_area)
        avg_y = total_y // len(dot_area)
        return(avg_x, avg_y)
    else:
        return(0,0)

def find_white_area(img, look_at, result):
    # uses floodfill algorithm. assumes (x, row) is white
    while(not(look_at == [])):
        location = look_at.pop()
        if(is_white(img.getpixel(location))):
            result.append(location)
            img.putpixel(location, 0)
            for delta_x in range(-1, 2):
                for delta_row in range(-1, 2):
                    if(not((delta_x == 0) and (delta_row == 0))):
                        if(delta_x + location[0] < img.width and delta_row + location[1] < img.height and delta_x + location[0] >= 0):
                            look_at.append((location[0] + delta_x, location[1] + delta_row))
    return result

def find_image_anchor(roll, image_index):
    image_dots = roll[image_index]
    max_x_value = image_dots[0][0]
    max_index = 0
    for tup_pos in range(1, len(image_dots)):
        if(image_dots[tup_pos][0] > max_x_value):
            max_x_value = image_dots[tup_pos][0]
            max_index = tup_pos
    anchor_y_value = image_dots[max_index][1]
    return((max_x_value, anchor_y_value))

def find_lowest_point(roll, image_index):
    image_dots = roll[image_index]
    max_y_value = image_dots[0][1]
    max_index = 0
    for tup_pos in range(1, len(image_dots)):
        if(image_dots[tup_pos][1] > max_y_value):
            max_y_value = image_dots[tup_pos][1]
            max_index = tup_pos
    anchor_x_value = image_dots[tup_pos][0]
    return((anchor_x_value, max_y_value))

def get_y_anchor_distance(roll, image_index):
    image_dots = roll[image_index]
    y_dot = find_lowest_point(roll, image_index)
    anchor = find_image_anchor(roll, image_index)
    distance = y_dot[1] - anchor[1]
    return distance

def find_max_roll_distance(roll):
    max_values = []
    for picture in range(0, len(roll)):
        max_values.append(get_y_anchor_distance(roll, picture))
    return max(max_values)

def find_max_binary_distance_y():
    max_values = []
    max_values.append(find_max_roll_distance(r503))
    max_values.append(find_max_roll_distance(r505))
    max_values.append(find_max_roll_distance(r506))
    return max(max_values)

def find_leftmost_binary(roll, image_index):
    image_dots = roll[image_index]
    min_x_value = image_dots[0][0]
    min_index = 0
    for tup_pos in range(1, len(image_dots)):
        if(image_dots[tup_pos][0] < min_x_value):
            min_x_value = image_dots[tup_pos][0]
            min_index = tup_pos
    associate_y_value = image_dots[min_index][1]
    return((min_x_value, associate_y_value))

def find_horizontal_binary_dist(roll, image_index):
    image_dots = roll[image_index]
    x_dot = find_leftmost_binary(roll, image_index)
    anchor = find_image_anchor(roll, image_index)
    distance = anchor[0] - x_dot[0]
    return distance

def find_max_roll_width(roll):
    max_values = []
    for picture in range(0, len(roll)):
        max_values.append(find_horizontal_binary_dist(roll, picture))
    return max(max_values)

def find_max_binary_distance_x():
    max_values = []
    max_values.append(find_max_roll_width(r503))
    max_values.append(find_max_roll_width(r505))
    max_values.append(find_max_roll_width(r506))
    return max(max_values)

r500 = []
r502 = []
r503 = []
r504 = []
r505 = []
r506 = []
all_dots = [r500, r502, r503, r504, r505, r506]

def check_dots_in_area(left, top, right, bottom, roll, image_index):
    image_dots = roll[image_index]
    exists = False
    for dots in image_dots:
        if (dots[0] >=left and dots[0] <= right and dots[1] >= top and dots[1] <= bottom):
            exists = True
    return exists

def translate_binary_img(roll, image_index):
    result = ''
    bin_values = ['', '', '', '', '', '', '', '', '', '']
    i_count = 0
    dots_list = roll[image_index]
    anchor = find_image_anchor(roll, image_index)
    a_x = anchor[0]
    data_width = find_max_binary_distance_x()
    actual_width = 9*(data_width //8 )
    x_step = actual_width // 9
    l_x = a_x - actual_width
    x_ranges= []
    for x in range(0,10):
        x_edge = l_x + x*(x_step) - (x_step //2)
        x_end = x_edge + x_step
        x_ranges.append(range(x_edge, x_end))
    a_y = anchor[1]
    b_y = a_y + find_max_binary_distance_y()
    y_step = (b_y - a_y) // 3 - 15
    y_ranges = []
    for y in range(0, 4):
        y_edge = a_y + y*(y_step) - (y_step //2) - 5
        y_end = y_edge + y_step - 5
        y_ranges.append(range(y_edge, y_end))
    for xval in x_ranges:
        for yval in range(len(y_ranges)-1, -1, -1):
            bin_values[i_count] += str(int(check_dots_in_area(xval.start, y_ranges[yval].start, xval.stop, y_ranges[yval].stop, roll, image_index)))
        i_count += 1
    for x in bin_values:
        result += str(int(x, 2))
    return result

n500=[]
n502=[]
n503=[]
n504=[]
n505=[]
n506=[]
all_names = [n500, n502, n503, n504, n505, n506]

folders_list = glob.glob("*")
f = open("report.txt", "w+")
str_list = "/*"
for i in range(0,6):
    for file in glob.glob(folders_list[i] + str_list):
        img = Image.open(file)
        try:
            print("Decoding " + file)
            dots = find_dots(img)
        except Exception:
            pass
        else:
            print(dots)
            all_dots[i].append(dots)
            f_name = file[4:]
            all_names[i].append(f_name)
            f.write("%s \n" % str(dots))
        f.write("\n")
    count = 0
print("Complete")
f.close()

f = open("metadata.txt", "w+")
folders_to_process = ['503', '505', '506']
dots_to_process = [r503, r505, r506]
names_to_process = [n503, n505, n506]
for roll in range(0, len(dots_to_process)):
    for dots in range(0, len(dots_to_process[roll])):
        metadata = translate_binary_img(dots_to_process[roll], dots)
        #roll number, filenumber, filename, metadata
        f.write("%s, %s, %s, %s \n" %(roll, names_to_process[roll][dots][5:9], names_to_process[roll][dots], metadata))
