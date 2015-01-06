outputdir <- "~/Desktop/"

# Small Multiples for the six goals
smallMultiples <- function(df, dates){
  par(mfrow=c(ncol(df),1), mar=c(1,3,1,.1), lwd=1, oma=c(3,0,.2,.2))
  x <- 1
  dateTicks <- seq(from = dates[1], to = tail(dates, n=1), length.out=5)
  for (i in df) {
    i <- as.numeric(levels(i))[i]
    plot(dates, i, frame=F, font.main = 1, main="", type="n", ylim=c(1,10), yaxt='n', xaxt="n", xlab="" , ylab="", col='#333333')
    quans <- quantile(i, names=FALSE)
    imean <- round(mean(i), digits=2)
    axis(side=2, at=5.5, lwd="0", lwd.ticks="0", las=0, labels=colnames(df)[x], line=0)
    axis(side=2, at=imean+.5, lwd="0", lwd.ticks="0", las=1, labels=imean, line=-2)
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

location <- data.frame(dt['value.Latitude'], dt['value.Longitude'])
dt <- data.frame(dt['datetime'],dt['value.Create'], dt['value.Relax'], dt['value.Love'], dt['value.Befriend'], dt['value.Health'], dt['value.Happiness'])

names(dt) <- c("datetime","Create","Relax","Love","Befriend","Health","Happiness")
dt <- dt[complete.cases(dt),]

dates <- c(as.Date(dt$datetime, format="%m/%d/%Y %I:%M:%S %p"))
#dates <- dt['datetime']

dt$datetime <- NULL
svg(filename=paste(outputdir, "goals.svg", sep=""), height=14, width=20, pointsize=40)
smallMultiples(dt, dates)
dev.off()

# Map Output
library(maps)
library(mapdata)
svg(filename=paste(outputdir, "map.svg", sep=""), height=12, width=20, pointsize=20)
map("state")
latitude <- as.numeric(levels(location$value.Latitude))[location$value.Latitude]
longitude <- as.numeric(levels(location$value.Longitude))[location$value.Longitude]
points(longitude, latitude, pch=19, col="blue")
dev.off()
