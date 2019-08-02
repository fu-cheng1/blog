package com.itzijin.service;

import com.itzijin.domain.Article;

import java.util.List;

/**
 * @Author: 陈尚宇
 * @Date: 2019/8/2 17:24
 * Function:
 */
public interface ArticleService {

    public List<Article> findAll();

    Article findById(String id);
}
