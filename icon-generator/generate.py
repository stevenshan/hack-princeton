import string
from PIL import Image, ImageDraw, ImageFont

colors = ["#c0b9dd", "#66c7f4", "#ef2d56", "#59c9a5", "#f55536", "#ffd23f", "#ee6352",
"#61d095",
"#53a548",
"#B91372"
]
for color in colors:
    img = Image.new("RGB", (256*8, 256*8), "white")
    draw = ImageDraw.Draw(img)
    draw.ellipse((0, 0, 256*8, 256*8), fill=color, outline=None)
    img.resize((256, 256), resample=Image.ANTIALIAS)
    img.save("icons/{}.png".format(color))
