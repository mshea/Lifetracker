outputdir <- "~/Desktop/"

# Small Multiples for the six goals
smallMultiples <- function(df, dates){
  par(mfrow=c(ncol(df),1), mar=c(1,5,1,.1), lwd=1, oma=c(3,.2,.2,.2))
  x <- 1
  dateTicks <- seq(from = dates[1], to = tail(dates, n=1), length.out=5)
  for (i in df) {
    i <- as.numeric(levels(i))[i]
    plot(dates, i, frame=F, font.main = 1, main="", type="n", ylim=c(1,10), yaxt='n', xaxt="n", xlab="" , ylab=colnames(df)[x], col='#333333')
    quans <- quantile(i, names=FALSE)
    imean <- round(mean(i), digits=2)
    axis(side=2, at=imean+.5, lwd="0", lwd.ticks="0", las=1, labels=imean)
    rug(jitter(i, amount=.3), side=2, ticksize = -.15, col='#aaaaaa')
    rect(dates[1], quans[2], dates[-1], quans[4], border="#eeeeee", col="#eeeeee")
    lines(dates, rep(imean, times=length(dates)), col="#aaaaaa")
    lines(dates, rep(1, times=length(dates)), col="#aaaaaa")
    lines(dates, rep(10, times=length(dates)), col="#aaaaaa")
    lines(dates, i, col="#666666", lwd=2)
    x <- x + 1
  }
  axis.Date(side=1, pos=c(-1), at=dateTicks, lwd="0", lwd.ticks="1", format="%d %b", col="#cccccc")
}

# Change the path below to the URL where you host your lifetracker app
d <- read.csv("~/Desktop/lifedata.csv")
d <- d[order(as.Date(d$datetime, format="%m/%d/%Y %I:%M:%S %p")),]
dt <- reshape(d, idvar="datetime", timevar="key", direction="wide")
location <- data.frame(dt['value.latitude'], dt['value.longitude'])
dt <- data.frame(dt['datetime'],dt['value.create'], dt['value.relax'], dt['value.love'], dt['value.befriend'], dt['value.health'], dt['value.happiness'])
names(dt) <- c("datetime","Create","Relax","Love","Befriend","Health","Happiness")
dt <- dt[complete.cases(dt),]
dates <- c(as.Date(dt$datetime, format="%m/%d/%Y %I:%M:%S %p"))
dt$datetime <- NULL
png(filename=paste(outputdir, "goals.png", sep=""), height=800, width=1200, pointsize=32)
smallMultiples(dt, dates)
dev.off()
svg(filename=paste(outputdir, "goals.svg", sep=""), height=14, width=20, pointsize=40)
smallMultiples(dt, dates)
dev.off()

# Binary Sparklines for the tags

binarySparkline <- function(d) {
  v <- 0
  par(mfrow=c(ncol(d),1), mar=c(.1,10,.1,.1), lwd=1)
  for (y in d) {
    v <- v + 1
    par(las=1)
    colName <- paste(colnames(d)[v], " ", sum(y))
    y <- c(y,0)
    x <- c(1:length(y))
    plot(x, y, space=NULL, type="n", pch=124, frame=F, xaxt='n',  yaxt="n", ann=FALSE, cex=1, col='#aaaaaa')
    # Build polygon construct
    y2 <- rep(y, each=2)
    y2 <- y2[-length(y2)]
    x2 <- rep(x, each=2)[-1]
    x3 <- c(min(x2), x2, max(x2))
    y3 <- c(0, y2, 0)
    polygon(x3, y3, border=NA, col="grey")
    axis(side=2, at=.5, pos=1, labels=colName, lwd=F)
  }
}

# Function for converting a set of date, key, values
# into a table of 0s and 1s sorted most to least. Used for binary Sparklines.
sortTagsIntoTable <- function(df) {
  ddf <- data.frame(df[1],df[2])
  ddf <- ddf[!duplicated(ddf),]
  tagtable <- table(ddf[2])
  tagframe <- as.data.frame(tagtable)
  sortedTags <- tagframe[with (tagframe, order(-Freq)),]
  topTags <- as.vector(sortedTags[[1]])
  dateTags <- data.frame(ddf[1], ddf[2])
  d <- as.data.frame.matrix(table(dateTags))[topTags][1:50]
}

# Output for binarySparklines with csv input
stopwords <- c("friend", "create", "relax", "love", "thinkingabout", "befriend", "health","happiness", "latitude", "longitude", "sp500", "weather_desc","temp_f")

dtags <- d
for (stopword in stopwords) {
  dtags <- dtags[dtags[,2] != stopword,]
}
dtags <- sortTagsIntoTable(dtags)

#d <- data.frame(replicate(50,sample(0:1,365,rep=TRUE)))
png(filename=paste(outputdir, "tags.png", sep=""), height=2000, width=1200, pointsize=40)
binarySparkline(dtags)
dev.off()
svg(filename=paste(outputdir, "tags.svg", sep=""), height=24, width=20, pointsize=40)
binarySparkline(dtags)
dev.off()

# Map Output
library(maps)
library(mapdata)
png(filename=paste(outputdir, "map.png", sep=""), height=900, width=1200, pointsize=24)
map("state")
latitude <- as.numeric(levels(location$value.latitude))[location$value.latitude]
longitude <- as.numeric(levels(location$value.longitude))[location$value.longitude]
points(longitude, latitude, pch=19, col="blue")
dev.off()
svg(filename=paste(outputdir, "map.svg", sep=""), height=16, width=20, pointsize=20)
map("state")
points(longitude, latitude, pch=19, col="blue")
dev.off()
