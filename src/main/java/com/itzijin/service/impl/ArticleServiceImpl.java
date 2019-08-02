package com.itzijin.service.impl;

import com.itzijin.dao.ArticleDao;
import com.itzijin.domain.Article;
import com.itzijin.service.ArticleService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.List;

/**
 * @Author: 陈尚宇
 * @Date: 2019/8/2 17:26
 * Function:
 */
@Service
public class ArticleServiceImpl implements ArticleService {

    @Autowired
    private ArticleDao articleDao;

    @Override
    public List<Article> findAll() {
        return articleDao.selectAll();
    }

    @Override
    public Article findById(String id) {
        return articleDao.selectByPrimaryKey(id);
    }

}
